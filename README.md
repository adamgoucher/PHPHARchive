PHPHARchive -- A programatic way of getting HAR information
===========================================================

##  DESCRIPTION

HAR files contain all sorts of interesting information that can be used when
automating functional testing of browser-based applications;

* how many items were downloaded
* what took the most time to download
* how many things were not from domains we control
* were there any 404's
* how many redirects just happened
* etc.

Getting a proxy to generate these files is not overly difficult but there was not
a project in PHP that could nicely parse and extract information with. So I wrote one.

PHPHARchive should parse and validate both 1.1 and 1.2 schema versions of the HAR
specification. Unfortunately it does it rather brute-forcely as the existing projects
for doing JSON Schema in PHP either don't seem to work or are not packaged for
distribution via PEAR.

##  INSTALLATION

*   This driver has been packaged for distribution via PEAR. So...

        pear channel-discover element-34.github.com/pear
        pear install -f element-34/PHPHARchive

##  EXAMPLES

* Getting all Entries for a particular page

        $h = new PHPHARchive_HAR('your.har');
        $entries = $h->get_entries_by_page_ref("page_1_0");

* Looking for a particular status

        $h = new PHPHARchive_HAR('your.har');
        $entries = $h->get_entries_by_page_ref("page_1_0");
        $four_oh_fours = array();
        foreach ($entries as $entry) {
          if ($entry->response->status == 404) {
            array_push($four_oh_fours, $entry);
          }
        }