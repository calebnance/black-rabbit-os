<?php
include('master.php');

if (Access::notLoggedIn()) {
    header('Location: index.php?msg=7');
    exit();
} elseif (Access::notPaid()) {
    header('Location: modules.php?msg=1');
    exit();
} else {
    FileHelper::checksession();
}

// get post
$post = $_POST;

// required fields
$requiredFields = [
    'author',
    'author_email',
    'author_url',
    'description',
    'filename',
    'name',
    'version'
];

// loop through required fields
foreach($requiredFields as $requiredField) {
    // if empty, no go
    if (empty($post[$requiredField])){
        $validPost = false;
        header('location:module.php?msg=1');
        exit();
    }
}

// form fields are validated, continue

$varObject = (object) array();
$varObject->return 		= "\n";
$varObject->tab1		= '	';
$varObject->tab2		= '		';
$varObject->tab3		= '			';
$varObject->tab4		= '				';
$varObject->midparent	= intval($post['midparent']);
$varObject->name		= FileHelper::preventInjection($post['name']);
$varObject->filename	= FileHelper::safeString($post['filename']);
$varObject->author		= FileHelper::preventInjection($post['author']);
$varObject->author_email= FileHelper::preventInjection($post['author_email']);
$varObject->author_url	= FileHelper::preventInjection($post['author_url']);
$varObject->version		= FileHelper::onlyVersion($post['version']);
$varObject->description	= FileHelper::preventInjection($post['description']);
$varObject->copyright	= FileHelper::preventInjection($post['copyright']);
$varObject->license		= FileHelper::preventInjection($post['license']);
$varObject->jversion	= FileHelper::onlyVersion($post['jversion']);
$varObject->brversion	= FileHelper::onlyVersion($post['brversion']);

// le Zip Array()
$filestozip = array();
// Lines created Array()
$totallinescreated = array();
// Index files
$indexlines = array();

// Create Folders
$folderusers = MAINDIR . DS . 'users' . DS;
$folderusersid = $folderusers . $_SESSION['uid'] . DS;
$folderusersmodules = $folderusersid . 'modules' . DS;
$folderusersmodulestmp = $folderusersmodules . 'tmp' . DS;
$folderusersmodulestmptmpl = $folderusersmodulestmp . DS . 'tmpl' . DS;

FileHelper::foldercheck($folderusers);
FileHelper::foldercheck($folderusersid);
FileHelper::foldercheck($folderusersmodules);
FileHelper::foldercheck($folderusersmodulestmp);
FileHelper::foldercheck($folderusersmodulestmptmpl);

// Create files
$modulelines		= ModuleHelper::modulefile($varObject);
$xmllines			= ModuleHelper::modulexml($varObject);
$helperlines		= ModuleHelper::helperfile($varObject);
$defaultlines		= ModuleHelper::defaultfile($varObject);

// Set filenames
$indexfile			= 'index.html';
$modulefile			= $folderusersmodulestmp . 'mod_' . $varObject->filename . '.php';
$xmlfile			= $folderusersmodulestmp . 'mod_' . $varObject->filename . '.xml';
$helperfile			= $folderusersmodulestmp . 'helper.php';
$defaultfile		= $folderusersmodulestmptmpl . 'default.php';

$totallinescreated[]= FileHelper::createFile($modulefile, $modulelines);
$totallinescreated[]= FileHelper::createFile($xmlfile, $xmllines);
$totallinescreated[]= FileHelper::createFile($helperfile, $helperlines);
$totallinescreated[]= FileHelper::createFile($defaultfile, $defaultlines);

// Zip Files
$filestozip[] = $modulefile;
$filestozip[] = $xmlfile;
$filestozip[] = $helperfile;
$filestozip[] = $defaultfile;

$indexlines[] = Files::indexFile();

// can't go into tmp directory!
$totallinescreated[] = FileHelper::createfile($folderusersmodules . $indexfile, $indexlines);

$indexpaths[]	= $folderusersmodulestmp . $indexfile;
$indexpaths[]	= $folderusersmodulestmptmpl . $indexfile;

// create index files under all paths
foreach($indexpaths as $indexpath):
    $totallinescreated[] = FileHelper::createfile($indexpath, $indexlines);
    $filestozip[] = $indexpath;
endforeach;

/**
 *	Lines created calculate
 */
$totallinescalculated = 0;
foreach($totallinescreated as $totallineseach):
    $totallinescalculated += $totallineseach;
endforeach;

// 15 seconds per line - round up or down..
$totaltimesaved = round($totallinescalculated / 4); // minutes

/**
 *	le Zip Up
 */
// set zip path
$packagename = 'mod_' . $varObject->filename . '-v.' . $varObject->version . '-joomla_' . $varObject->jversion . '.zip';
// create the zip package
$filescreatedlist = FileHelper::createZip($filestozip, $folderusersmodulestmp.$packagename, false, $folderusersmodulestmp);

// get size of package
$bytes = filesize($folderusersmodulestmp.$packagename);
$filecreatedcount = count($filescreatedlist);

// format numbers
$filecreatedcount_format = number_format($filecreatedcount);
$totallinescalculated_format = number_format($totallinescalculated);

// connect to database
$database = new Database(HOST, DBNAME, DBUSER, DBPASS);

// posted data
$posted_date = date('Y-m-d H:i:s');

// insert into database
$varObject->description = str_replace("'", "\'", $varObject->description);
$create_package_record = array (
    'uid'			=> $_SESSION['uid'],
    'midparent'		=> $varObject->midparent,
    'm_name'		=> $varObject->name,
    'm_file_name'	=> $varObject->filename,
    'version'		=> $varObject->version,
    'jversion'		=> $varObject->jversion,
    'brversion'		=> $varObject->brversion,
    'description'	=> $varObject->description,
    'license'		=> $varObject->license,
    'copyright'		=> $varObject->copyright,
    'author'		=> $varObject->author,
    'author_email'	=> $varObject->author_email,
    'author_url'	=> $varObject->author_url,
    'date_created'	=> $posted_date,
    'filesize'		=> $bytes,
    'lines_created'	=> $totallinescalculated,
    'files_created'	=> $filecreatedcount,
    'minutes_saved'	=> $totaltimesaved,
    'download_count'=> 1
);

$mid = $database->insert('br_modules', $create_package_record);

$filesize = FileHelper::formatBytes($bytes);

// Move to user folder from tmp
$userfolder = $folderusersmodules . $mid . DS;
FileHelper::foldercheck($userfolder);
FileHelper::createfile($userfolder . $indexfile, $indexlines);
FileHelper::copyToLocation($folderusersmodulestmp.$packagename, $userfolder.$packagename);
$filecreatedpath = BASE_URL . 'users' . DS . $_SESSION['uid'] . DS . 'modules' . DS . $mid . DS . $packagename;

// clean up tmp folder now that zip has been created
FileHelper::deleteDir($folderusersmodulestmp);

// set permissions of paths
chmod($folderusersmodules, 0777);
chmod($userfolder, 0777);

// call header
$pageTitle = 'Module Created | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'modules';
$pageActiveBreadcrumb = '<li class="active">Module Created</li>';
include('template/header.php');
?>

<div id="section-container">
    <div class="container">
        <div class="row">
            <div class="span12">
                <?php
                if ($filescreatedlist) {
                ?>
                    <div class="jumbotron">
                        <h2><?php echo $varObject->name; ?> module has been created...</h2>
                        <p id="step1" class="lead">Total files created: <?php echo $filecreatedcount_format; ?></p>
                        <p id="step2" class="lead">Total lines created: <?php echo $totallinescalculated_format; ?></p>
                        <p id="step3" class="lead">Total time saved: <?php echo $totaltimesaved; ?> Minutes <span class="small">(if it took 15 seconds per line to write)</span></p>
                        <p id="countdowntime"><span class="badge badge-inverse">15</span> seconds</p>
                        <a class="btn btn-large btn-success" id="download-full-package" href="<?php echo $filecreatedpath; ?>">Download (<?php echo $filesize; ?>)</a>
                        <br />
                        <br />
                        <hr>
                        <a href="contact.php" target="_blank" class="btn">Suggest a better process</a>
                        <br />
                        <br />
                        <p class="lead">Please let me know what can be done to make this tool easier for you! I want this to be a great tool, but need feedback.</p>
                    </div>
                <?php
                } else {
                ?>
                    <div class="jumbotron">
                        <h1><img src="images/black-rabbit.png" width="100"> Black Rabbit<br />Component Creator</h1>
                        <p class="lead">Tired of creating a file structure every time you create a new component for Joomla? Let us do it for you! This <strong>easy-to-use</strong> tool creates an installable component package from the configurations you set below. Just select which <strong>Joomla version</strong> you want it to install to and get to typing. No sign-up necessary!</p>
                        <a class="btn btn-large btn-success" href="index.php#start">Get Started</a>
                    </div>
                <?php
                }
                ?>
            </div><!-- /.span12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /#section-container -->
<?php
// Call footer
include('template/footer.php');
