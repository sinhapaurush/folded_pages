<?php
    include('modules/tminc.php');
    if ($conn = mysqli_connect($server, $user, $pass, $db)){
        $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".cookie('User')."' AND `password` LIKE '".cookie('Pass')."'";
        if ($run = mysqli_query($conn, $sql)){
            if (0 < mysqli_num_rows($run)){
                $data = mysqli_fetch_array($run);
            save_cookie('User', cookie('User'));
            save_cookie('Pass', cookie('Pass'));
            $allow = false;
            foreach(json_decode($data['fp_batches']) as $col){
                $vals = explode('<tminc>', $col);
                if ($vals[1] === $_GET['id']){
                        $allow = true;
                    }
                }
                if ($allow === true){
    boiler('Folded Pages - Notes &bull; TMINC', 
    'Login to Folded pages as student, TMINC, folded Pages, fp, student, students', 
    'Folded Pages, Student Login', 
    true, 
    '    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">', 
    $theme_color, $favicon, $common_head_tag //DON'T EDIT THESE VARIABLES
    );
    import(array('header', 'contdata'));
    css('def');    
    css('dash');
    css('cont');
    head($name);
    html('<div class=\'dprnt\'>');
    markupa($_GET['id']);
    $sqli = "SELECT * FROM `fp_notes` WHERE `batch` LIKE '".$_GET['id']."' AND (`allow` LIKE 'true' OR `allow` LIKE '%".cookie('User')."%') order by `id` desc";
    if ($get = mysqli_query($conn, $sqli)){
        if (0 < mysqli_num_rows($get)){
            while($getv = mysqli_fetch_array($get)){
            adddoc(array('title'=>$getv['title'], 'type'=>$getv['type'], 'point'=>$getv['drive']));
            }
        }else{
            html('No Document is available for you.');
        }
    }else{
        errorn('Query Broke! Contact TMINC');
        html($sqli);
        error('Query Broke, Report this issue at tminc.ml/bug');
    }
    markupb();
    html('</div>');
    last();
            }else{
                alert('You aren not allowed to access this batch.');
                open('dashboard.php');
            }
}else{
    alert('Password of Your account got changed!, Login again.');
    delete_cookie('User');
    delete_cookie('Pass');
    open('index.php');
}
}else{
    errorn('Broken Query Provided, Contact TMINC');
        error('QUERY BROKE, SERVER SIDE FAULT.');
        warn('Report Bug at tminc.ml/bug');
}
}else{
erron('Error Connecting DatabasE, Please try again later or contact TMINC.');
error('CONNECTION FAULT, SERVER SIDE FAULT.');
warn('Contact TMINC');

}
?>
