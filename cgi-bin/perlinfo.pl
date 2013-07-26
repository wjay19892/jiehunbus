#!/Applications/AMPPS/perl/bin/perl -w

use HTML::Perlinfo;
use CGI qw(header);
$q = new CGI;

#print "Content-Type: text/html\n\n";
print $q->header;
print "<html><head></head>";
print "<body><p><a href='http://localhost/ampps'>Back to AMPPS Home</a><center><h2>Perl Info</h2></center></p>";
print "</body></html>";

$p = new HTML::Perlinfo;
$p->info_general;
$p->info_variables;
$p->info_modules;
$p->info_license;