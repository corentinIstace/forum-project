<?php

// Temprary file for simple implementation of avatar/gravatar and compression testing

// Libraries
require_once '../app/libraries/Gravatar.php';
require_once '../app/libraries/DatabaseManager.php';

// Model
require_once 'config/config.php';

// Users model
class Users extends DatabaseManager
{
  // Set an avatar to an user
  public function setUserAvatar($id, $avatar)
  {
    $db = $this->connectDb();
    $req = $db->prepare("UPDATE users
                        SET avatar=:avatar
                        WHERE id=:id");
    $req->execute([
      'id' => $id, 
      'avatar' => $avatar
    ]);
  }
  // Get user
  public function getUser($id)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT * FROM users WHERE id=:id");
    $req->execute(['id'=>$id]);
    return $req->fetch(PDO::FETCH_ASSOC);
  }
  // Use the compress sql function if available
  public function compress($data)
  {
    $db = $this->connectDb();
    $req = $db->prepare("SELECT COMPRESS(:data) AS C, UNCOMPRESS(COMPRESS(:data)) AS U");
    $req->execute(['data'=>$data]);
    return $req->fetch(PDO::FETCH_ASSOC);
  }
}

// Controller

define("MAX_BYTE_SIZE", 65535);

// Search if an avatar exist in db, else gather from gravatar
Function getAvatar($id)
{
  // Check if id is valid then if user exist
  $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
  if(!$id){
    echo "ID invalid";
    return;
  }
  $user = (new Users)->getUser($id);
  if(!$user){
    echo "User not found";
    return;
  }

  // get avatar for display
  // If not available in user (from db), get the gravatar's user
  $gravatar = new Gravatar;
  if(!$user['avatar']){
    if($gravatar->setEmail($user['email'])){
      // get from Gratavar
      return $gravatar->getSrc();      
    }
    return "";
  }
  return uncompressAvatar($user['avatar']);
}

function updateAvatar($id, $avatar)
{
  // Check if id is valid then if user exist
  $id = filter_has_var(INPUT_GET, 'id') ? filter_var(trim($_GET['id']), FILTER_SANITIZE_NUMBER_INT) : null;
  if(!$id){
    echo "ID invalid";
    return;
  }
  $user = (new Users)->getUser($id);
  if(!$user){
    echo "User not found";
    return;
  }

  (new Users)->setUserAvatar($id, $avatar);
}

// Get an avatar url and return it sanitized
function sanitizeAvatar($avatar)
{
  if(!$avatar) { return false; }
  $avatar = filter_var($avatar, FILTER_SANITIZE_STRING);
  return $avatar;
}

// Get an avatar url and make validation on length
function validateAvatar($avatar)
{
  if(gettype($avatar) != "string") echo "<br>not string";
  if(strlen($avatar) > MAX_BYTE_SIZE) echo "<br>Failed size validation : " . strlen($avatar) . " " . MAX_BYTE_SIZE;
  if(!$avatar || $avatar == "") { return false; }
  if(gettype($avatar) != "string" || strlen($avatar) > MAX_BYTE_SIZE) { return false; }
  return $avatar;
}

// Get an uploaded avatar, compress it with gzdeflate
function compressAvatar($avatar)
{
  return gzdeflate($avatar, 6);
}

// Get an avatar from DB, uncompress it with gzinflate
function uncompressAvatar($avatar)
{
  return gzinflate($avatar);
}

// "Main"
$id = $_GET['id'] ?? null;
$avatarSource = "";

// If user don't post, update img avatar src
// else process tests from the avatar
if(!isset($_POST['avatar'])){  
  echo "<h3>Avatar from DB/Gravatar</h3>";
  $avatarSource = getAvatar($id);
}
else {

  echo "Proceed to validation and upload";
  $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : null;
  $original = isset($_POST['avatar']) ? $_POST['avatar'] : null;
  $avatar = validateAvatar(compressAvatar(sanitizeAvatar($avatar)));
  if(!$avatar) { 
    echo "<br>Avatar invalide. Maximum ".MAX_BYTE_SIZE." bytes";
    return;
  }
  // Set avatar in DB for user
  updateAvatar($id, $avatar);
  echo "<br>Validation passed, db updated";
  // Get avatar from DB for user
  $avatar = getAvatar($id);
  echo "<br><br>Get avatar from db : ";
  echo "<br><img src='".$avatar."' >";
  echo "<br>";
  echo $original == $avatar ? "Matching" : "Not matching";

  // Testing
  /* echo "<h3>Testing process around image url compression</h3>";
  $data = $_POST['avatar'];
  $deflated = gzdeflate($data, 6);
  $inflated = gzinflate($deflated);
  echo "Original url length : ". strlen($data) . "<br><br>";
  echo "gzcompress<br>";
  for($i = 0 ; $i < 10 ; $i++){
    echo $i . ") " . strlen(gzcompress($data, $i)) . "<br>";
  }
  echo "<br>gzdeflate<br>";
  for($i = 0 ; $i < 10 ; $i++){
    echo $i . ") " . strlen(gzdeflate($data, $i)) . "<br>";
  }
  echo "<br>gzencode<br>";
  for($i = 0 ; $i < 10 ; $i++){
    echo $i . ") " . strlen(gzencode($data, $i)) . "<br>";
  }
  echo "<br>MySQL Compress : ";
  echo "<br>Compressed url lengths <br>";
  $sqlCompressArray = (new Users())->compress($data);
  echo strlen($sqlCompressArray['U']);
  echo " ";
  echo strlen($sqlCompressArray['C']);
  echo "<br>Compression with mysql reduce url length to ";
  echo (int)(strlen($deflated) / strlen($data) * 100);
  echo "% of the original url length";
  echo "<br>Is uncompress matching original<br>";
  echo $data == $sqlCompressArray['U'] ? "matching" : "not matching";
  echo "<br>(mySQL compress and gzcompress use both zlib)";
  echo "<br><br>I will take gzdeflate level 6 as my choice";
  echo "<br>Additional testings showed that a 150*150 png file compressed with gzdeflate 6 take ~64KB, just below the ~65KB allowed by text type in DB side.";
  echo "<br><br>Are original and uncompressed matching ?";
  echo "<br> url lengths : " . strlen($data) . " " . strlen($deflated) . "<br>";
  echo  $data == $inflated ? "matching" : "not matching";
  echo "<br>Compression with gzdeflate 6 reduce url length to ";
  echo (int)(strlen($deflated) / strlen($data) * 100);
  echo "% of the original url length";
  echo "<br><br>Testing sanitazing";
  echo "<br>";
  echo $data == sanitizeAvatar($data) ? "<b>Pass sanitazing</b>" : "<b>Don't pass sanitizing</b>"; */
}

// End of php and begin of html display (view)
?>

<body>
  <div id="uploadImage">
    <div id="preview">
      <img id="previewDisplay" src="<?= $avatarSource ?? '' ?>" >
      <p id="pre">preview</p>
    </div>
    <p>Upload Image</p>
  </div>
  <form class="form" id="imageInput">
    <input id="imageFile" type="file" onchange="previewFile()" accept="image/*" /><br />
  </form>
  <form action="" method="post" id="uploaderForm">
    <input type="text" name="avatar" id="avatar" hidden="true" />
    <button type="button" onclick="sendForm()" >Send new avatar</button>
  </form>
  <script src="../public/js/avatarHandler.js"></script>
</body>
