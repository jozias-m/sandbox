<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Jozias Mijovas">
    <!-- Jozias Mijova (c) 2025 -->
    <meta http-equiv="refresh" content="3600">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body class="darkMode">
    <header>
        <div class="halfNewLine">
            <div class="content">
                <p class="noNewLine">Header
                <button onclick="toggleDarkMode()" class="toggleButton">Toggle&nbsp;dark&nbsp;mode</button>
                </p>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="ad-left">
            <p>[ads]</p>
        </div>
        <div class="content">
            <h1>Blocking AI on your laptop</h1>
            <br><hr><hr>
            <h2>DNS blocklist</h2>
            <p class="inlineNote"><i>This methos only works for Windows</i></p>
            <p class="noNewLine">
                    After downloading the 'hosts' file, move it to "C:\Windows\System32\drivers\etc\". If you want/need to unblock a specific domain
                you can open the file in notepad and delete the line that has the website you want to block--some websites have multiple entries, you'll need to delete all of them.
            </p>
            <a href="./hostsx"  class="altLinkFormat" download="hosts">DNS blocklist download</a>
            <br><br><hr>
            <h2>Chrome Extension</h2>
            <p class="inlineNote"><i>This method works for all chrome based browsers (e.g. Chrome, firefox, edge, brave, etc.)</i></p>
            <a href="https://chromewebstore.google.com/detail/ai-block/bepbbcpgoljdlbihghneodnejodaeiih" class="altLinkFormat" target="_blank">Extension one</a>
            <a href="https://chromewebstore.google.com/detail/is-generated-block-ai-con/chccpjfkgkgogeaaekpgoocmcekajgjk" class="altLinkFormat" target="_blank">Extension two</a>
            <a href="https://chromewebstore.google.com/detail/aiblock-block-ai-images-a/mkmlbdghcbklnojegbkcdhfonmmopgdc" class="altLinkFormat" target="_blank">Extension three</a>
            <a href="https://chromewebstore.google.com/detail/ai-content-shield-ai-dete/eoghcliblbhjimkgnfemelcpfdnmiceo" class="altLinkFormat" target="_blank">Extension four</a><br>
            <p>Installing these four chrome extensions block most AI sections on most websites</p>
            <br><br><hr>
            <h2>Suggest your own method</h2>
            <p>
                    This website was made quickly and by one person. I'm not an expert on 'blocking AI', as such I don't know all the methods
                that can be used to block AI. The methods listed on this site are the methods I personaly use. If you have your own method
                please suggest it to me from one of these methods: <a href="mailto:jozias.mijova+blockAI@gmail.com" class="altLinkFormat">Email</a>,
                <a href="https://t.me/jozias_m" class="altLinkFormat">Telegram</a>, <a href="http://discord.com/users/1402282462616489987" class="altLinkFormat">Discord</a>
                or <a href="https://bsky.app/profile/jozias-m.bsky.social" class="altLinkFormat">Bluesky</a>
            </p>
        </div>
        <div class="ad-right">
            <p>
                [ads]
            </p>
        </div>
    </div>
    <footer>
        <div class="content">
            <p>Footer</p>
        </div>
    </footer>
    <br>
    // Source - https://stackoverflow.com/a
// Posted by Mihai, modified by community. See post 'Timeline' for change history
// Retrieved 2025-11-23, License - CC BY-SA 4.0

<?php
// Script Online Users and Visitors - http://coursesweb.net/php-mysql/
if(!isset($_SESSION)) session_start();        // start Session, if not already started

$filetxt = 'userson.txt';  // the file in which the online users /visitors are stored
$timeon = 120;             // number of secconds to keep a user online
$sep = '^^';               // characters used to separate the user name and date-time
$vst_id = '-vst-';        // an identifier to know that it is a visitor, not logged user

/*
 If you have an user registration script,
 replace $_SESSION['nume'] with the variable in which the user name is stored.
 You can get a free registration script from:  http://coursesweb.net/php-mysql/register-login-script-users-online_s2
*/

// get the user name if it is logged, or the visitors IP (and add the identifier)

    $uvon = isset($_SESSION['nume']) ? $_SESSION['nume'] : $_SERVER['SERVER_ADDR']. $vst_id;

$rgxvst = '/^([0-9\.]*)'. $vst_id. '/i';         // regexp to recognize the line with visitors
$nrvst = 0;                                       // to store the number of visitors

// sets the row with the current user /visitor that must be added in $filetxt (and current timestamp)

    $addrow[] = $uvon. $sep. time();

// check if the file from $filetxt exists and is writable

    if(is_writable($filetxt)) {
      // get into an array the lines added in $filetxt
      $ar_rows = file($filetxt, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $nrrows = count($ar_rows);

            // number of rows

  // if there is at least one line, parse the $ar_rows array

      if($nrrows>0) {
        for($i=0; $i<$nrrows; $i++) {
          // get each line and separate the user /visitor and the timestamp
          $ar_line = explode($sep, $ar_rows[$i]);
      // add in $addrow array the records in last $timeon seconds
          if($ar_line[0]!=$uvon && (intval($ar_line[1])+$timeon)>=time()) {
            $addrow[] = $ar_rows[$i];
          }
        }
      }
    }

$nruvon = count($addrow);                   // total online
$usron = '';                                    // to store the name of logged users
// traverse $addrow to get the number of visitors and users
for($i=0; $i<$nruvon; $i++) {
 if(preg_match($rgxvst, $addrow[$i])) $nrvst++;       // increment the visitors
 else {
   // gets and stores the user's name
   $ar_usron = explode($sep, $addrow[$i]);
   $usron .= '<br/> - <i>'. $ar_usron[0]. '</i>';
 }
}
$nrusr = $nruvon - $nrvst;              // gets the users (total - visitors)

// the HTML code with data to be displayed
$reout = '<div id="uvon"><h4>Online: '. $nruvon. '</h4>Visitors: '. $nrvst. '<br/>Users: '. $nrusr. $usron. '</div>';

// write data in $filetxt
if(!file_put_contents($filetxt, implode("\n", $addrow))) $reout = 'Error: Recording file not exists, or is not writable';

// if access from <script>, with GET 'uvon=showon', adds the string to return into a JS statement
// in this way the script can also be included in .html files
if(isset($_GET['uvon']) && $_GET['uvon']=='showon') $reout = "document.write('$reout');";

echo $reout;             // output /display the result
?>

</body>
</html>
