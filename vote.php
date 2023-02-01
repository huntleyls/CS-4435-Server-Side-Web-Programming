<html>
<head><title>Results of the Vote</title></head>
<body bgcolor="#CCFFCC" text="#330099">
<?php
# Uncomment the following two lines to see errors in PHP.
# error_reporting(E_ALL);
# ini_set('display_errors', 1);
# see which figure the user selected and set
# variable $choice to the value associated with 
# the radio button selected
$choice = $_POST['choice'];

# open the file named vote.dat for reading and writing
$fp = fopen ("vote.dat", "r+b");
# lock the file so nobody else can open it right now
flock ($fp, LOCK_EX);

# read first number in file and put it in $blackTruckcount
$blackTruckcount = (int) fgets($fp, 80);

# read second number and put it in $greyTruckcount
$greyTruckcount  = (int) fgets($fp, 80);

# read third number and put it in $whiteTruckcount
$whiteTruckcount = (int) fgets($fp, 80);

# read third number and put it in $whiteTruckcount
$yellowTruckcount = (int) fgets($fp, 80);

# increment the right variable
if ($choice == "blackTruck") {
    $blackTruckcount = $blackTruckcount + 1;
}
else if ($choice == "greyTruck") {
    $greyTruckcount = $greyTruckcount + 1;
}
else if ($choice == "whiteTruck") {
    $whiteTruckcount = $whiteTruckcount + 1;
}
else if ($choice == "yellowTruck") {
    $yellowTruckcount = $yellowTruckcount + 1;
}
else {
   # if the user didn't vote, don't increment anything
}

# put the three numbers back in the file, one per line
fseek ($fp, 0);
fwrite($fp, "$blackTruckcount\n$greyTruckcount\n$whiteTruckcount\n$yellowTruckcount\n");

# unlock and close the file
flock($fp, LOCK_UN);
fclose($fp);

# print the user's vote acknowledgement
if ($choice == "blackTruck") {
    echo "<h2>You voted for CBR!</h2> \n";
}
else if ($choice == "greyTruck") {
    echo "<h2>You voted for Optima!</h2>\n";
}
else if ($choice == "yellowTruck") {
    echo "<h2>You voted for Cool It!</h2>\n";
}
else if ($choice == "whiteTruck") {
    echo "<h2>You voted for Sintor!</h2>\n";
}
else {
    echo "<h2>You didn't vote!</h2>\n";
}
//End the php
?>

<!--- print the vote counts in a table using HTML -->
<h2>So far the votes are as follows:</h2>
<hr>
<table>
  <tr>
    <td>CBR</td><td><?php echo $blackTruckcount; ?></td>
  </tr>
  <tr>
    <td>Optima</td><td><?php echo $greyTruckcount; ?></td>
  </tr>
  <tr>
    <td>Cool it</td><td><?php echo $yellowTruckcount; ?></td>
  </tr>
  <tr>
    <td>Sintor</td><td><?php echo $whiteTruckcount; ?></td>
  </tr>
</table>
<hr>
</body>
</html>




