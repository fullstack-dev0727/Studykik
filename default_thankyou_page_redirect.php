<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script>
        window.setTimeout(function(){
            window.location.href = '<?php echo $_POST['redirect_url']; ?>/?custom_mobile_phone_number=<?php echo $_POST['custom_Mobile_Phone_Number'];?>&email=<?php echo $_POST['email'];?>&from=<?php echo $_POST['email'];?>&post_id=<?php echo $_POST['post_id'];?>&uname='+encodeURIComponent("<?php echo $_POST['name'];?>");
        },500);
    </script>
</head>
<body>
    Loading ...
</body>
</html>