<?php
// 161114CM check recursively for newest less/scss-File. If modified, update the parent file time.
$path = realpath(__DIR__.'/.');
$type = "scss"; //scss or less
$includefile = __DIR__."/app.".$type; // the less/scss-File which includes other files
$last_modified_time = 0;

// check recursively for newest .less/scss file
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
{
    if ($filename != "." && $filename != ".." && preg_match("/\.".$type."$/i",$filename))
    {
        $filetime = filemtime($filename);
        if ($filetime > $last_modified_time)
        {
            $last_modified_time = $filetime;
            $last_modified_file = $filename;
            //echo $filename." ($etag) [$last_modified_time]\n";
        }
    }
}

if ($last_modified_time > filemtime($includefile)) // there is a included less/scss-file which is newer.
{
    touch($includefile,$last_modified_time); // update the timestamp of the parent lesss/scss file.
    file_put_contents(__DIR__."/lastmodified.log",$last_modified_time);
}
