# contao-combiner-refresh
Less/SCSS files which are combined are incorrectly calculated by Contao: Changes in sub-Files are not recognized. This script checks the filetime of the sub-Files in the folder and corrects the filetime of the parent `app.less/scss`

Therefore, the `checkmodified.php` is placed into the main less/scss directory (e.g., `files/layout/scss/`) where also the `app.less/scss` file lies.

Then, a line with the correct (relative or absolute) path to `checkmodified.php` is added in `system/config/initconfig.php` to process this file on every page load during Contao initialization:

```
// Check if we have modified sub-less/scss-files. If so, modify the parent less/scss-file so that a new complete less/scss.css-file can be generated
$checkmodified = "../files/layout/scss/checkmodified.php"; if (file_exists($checkmodified)) include_once($checkmodofied);
```
