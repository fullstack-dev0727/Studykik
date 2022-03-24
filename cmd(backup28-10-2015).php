<?
// Domain Masking script generated and powered by
// Marketer's Choice(c) 2015
// http://www.marketerschoice.com
// ***** DO NOT REMOVE *****
define("SCRIPT_VERSION", "0.5");
// The following is used for tracking and validation purposes.
if (strcasecmp($_REQUEST["cmd"], "version") == 0) {
    echo SCRIPT_VERSION;
    exit();
}
// ***** DO NOT REMOVE *****

$mid = "A33B5E2F-FA3D-4916-B7EC-9BB15B9589A2";

$merchantId = "268349";
$merchantUrl = "www.studykik.com";
$baseUrl = "http://www.marketerschoice.com";
$dest = $baseUrl . "/app/default.asp?id=" . $merchantId;

if (isset($_REQUEST["pid"]))
    $pid = $_REQUEST["pid"];
else
    $pid = '';
if (isset($_REQUEST["bid"]))
    $bid = $_REQUEST["bid"];
else
    $bid = '';
if (isset($_REQUEST["gid"]))
    $gid = $_REQUEST["gid"];
else
    $gid = '';

if (isset($_REQUEST["cmd"]))
    $cmd = $_REQUEST["cmd"];
else if (isset($_REQUEST["CMD"]))
    $cmd = $_REQUEST["CMD"];
else if (isset($_REQUEST["Cmd"]))
    $cmd = $_REQUEST["Cmd"];
else
    $cmd = '';

if (isset($_REQUEST["id"]))
    $id = $_REQUEST["id"];
else if (isset($_REQUEST["ID"]))
    $id = $_REQUEST["ID"];
else if (isset($_REQUEST["Id"]))
    $id = $_REQUEST["Id"];
else
    $id = '';

if (isset($_REQUEST["af"]))
    $af = $_REQUEST["af"];
else if (isset($_REQUEST["AF"]))
    $af = $_REQUEST["AF"];
else if (isset($_REQUEST["Af"]))
    $af = $_REQUEST["Af"];
else
    $af = '';

if (isset($_REQUEST["ad"]))
    $ad = $_REQUEST["ad"];
else if (isset($_REQUEST["AD"]))
    $ad = $_REQUEST["AD"];
else if (isset($_REQUEST["Ad"]))
    $ad = $_REQUEST["Ad"];
else {
    if (isset($_REQUEST["imp"])) {
        $ad = $_REQUEST["imp"];
        $cmd = "imp";
    } else if (isset($_REQUEST["Imp"])) {
        $ad = $_REQUEST["Imp"];
        $cmd = "imp";
    } else {
        if (isset($_REQUEST["clk"])) {
            $ad = $_REQUEST["clk"];
            $cmd = "clk";
        } else if (isset($_REQUEST["Clk"])) {
            $ad = $_REQUEST["Clk"];
            $cmd = "clk";
        } else
            $ad = '';
    }
}

if (isset($_REQUEST["u"]))
    $u = $_REQUEST["u"];
else if (isset($_REQUEST["U"]))
    $u = $_REQUEST["U"];
else
    $u = '';

if (isset($_REQUEST["email1"]))
    $email1 = $_REQUEST["email1"];
else if (isset($_REQUEST["EMAIL1"]))
    $email1 = $_REQUEST["EMAIL1"];
else if (isset($_REQUEST["Email1"]))
    $email1 = $_REQUEST["Email1"];
else
    $email1 = '';

if ($pid != "" || $bid != "" || $gid != "")
    $dest = $baseUrl . "/SecureCart/SecureCart.aspx?mid=" . $mid . "&" . $_SERVER['QUERY_STRING'];
else if ($cmd != "") {
    switch (strtolower($cmd)) {
        case "cart":
            $dest = $baseUrl . "/SecureCart/SecureCart.aspx?mid=" . $mid;
            break;
        case "checkout":
            $dest = $baseUrl . "/SecureCart/SecureCart.aspx?mid=" . $mid . "&co=1";
            break;
        case "login":
            $dest = $baseUrl . "/SYS/?m=" . $merchantId . "&c=l";
            break;
        case "signup":
            $dest = $baseUrl . "/SYS/?m=" . $merchantId . "&c=s";
            break;
        case "cancel":
            $dest = $baseUrl . "/app/removesave.asp?merchantid=" . $merchantId . "&clientid=" . $id . "&removear=Yes";
            break;
        case "update":
            $dest = $baseUrl . "/app/r.asp?merchantid=" . $merchantId . "&id=" . $id . "&c=1";
            break;
        case "imp":
            $dest = "http://www.mcssl.com/SecureClient/track.ashx?" . $ad . "&3";
            break;
        case "clk":
            $dest = "http://www.mcssl.com/SecureClient/track.ashx?" . $ad . "&2";
            break;
        default:
            $dest = $merchantUrl;
    }
} else {
    if ($af != "")
        $dest = "http://www.mcssl.com/SecureClient/track.ashx?" . $af . "&1&mid=" . $merchantid . "&u=" . $u;
    else if ($ad != "")
        $dest = "http://www.mcssl.com/SecureClient/track.ashx?" . $ad . "&6";
    else if ($email1 != "") {
        $dest = $baseUrl . "/app/contactsave.asp?merchantid=" . $merchantId;
        if ($_SERVER['QUERY_STRING'] != "")
            $dest = $dest . "&" . $_SERVER['QUERY_STRING'];
        if ($_POST) {
            foreach ($POST as $key => $value)
                $dest = $dest . "&" . $key . "=" . $value;
        }
    }
}

header("Location: " . $dest);
exit();
?>