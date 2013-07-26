<?php

class Excel{

    /**
     * Header of excel document (prepended to the rows)
     * 
     * Copied from the excel xml-specs.
     * 
     * @access private
     * @var string
     */
    var $header = '';

    /**
     * Footer of excel document (appended to the rows)
     * 
     * Copied from the excel xml-specs.
     * 
     * @access private
     * @var string
     */
    var $footer = '';

    /**
     * Document lines (rows in an array)
     * 
     * @access private
     * @var array
     */
    var $lines = array ();

    /**
     * Worksheet title
     *
     * Contains the title of a single worksheet
     *
     * @access private 
     * @var string
     */
    var $worksheet_title = "Table1";

    /**
     * Add a single row to the $document string
     * 
     * @access private
     * @param array 1-dimensional array
     * @todo Row-creation should be done by $this->addArray
     */

	function __construct()
    {
        $this->header = $this->GetHeader();
		$this->footer = $this->GetFooter();
    }

	
	function GetHeader()
    {
        $lastsav = date("e");
        $header = <<<EOH
				<html xmlns:o="urn:schemas-microsoft-com:office:office"
				xmlns:x="urn:schemas-microsoft-com:office:excel"
				xmlns="http://www.w3.org/TR/REC-html40">

				<head>
				<meta http-equiv=Content-Type content="text/html; charset=utf-8">
				<meta name=ProgId content=Excel.Sheet>
				<!--[if gte mso 9]><xml>
				 <o:DocumentProperties>
				  <o:LastAuthor>Collabtive</o:LastAuthor>
				  <o:LastSaved>$lastsav </o:LastSaved>
				  <o:Version>1</o:Version>
				 </o:DocumentProperties>
				 <o:OfficeDocumentSettings>
				  <o:DownloadComponents/>
				 </o:OfficeDocumentSettings>
				</xml><![endif]-->
				  <style>
					<!-- @page
						{margin:1.00in 0.75in 1.00in 0.75in;
						mso-header-margin:0.50in;
						mso-footer-margin:0.50in;}
					tr
						{mso-height-source:auto;
						mso-ruby-visibility:none;}
					col
						{mso-width-source:auto;
						mso-ruby-visibility:none;}
					br
						{mso-data-placement:same-cell;}
					.font0
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font1
						{color:windowtext;
						font-size:12.0pt;
						font-weight:700;
						font-style:normal;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font2
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:italic;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font3
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font4
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font5
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:underline;
						text-underline-style:single;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.font6
						{color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:"宋体";
						mso-generic-font-family:auto;
						mso-font-charset:134;}
					.style0
						{mso-number-format:"General";
						text-align:general;
						vertical-align:bottom;
						white-space:nowrap;
						mso-rotate:0;
						mso-pattern:auto;
						mso-background-source:auto;
						color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:宋体;
						mso-generic-font-family:auto;
						mso-font-charset:134;
						border:none;
						mso-protection:locked visible;
						mso-style-name:"Normal";
						mso-style-id:0;}
					.style16
						{font-style:italic;
						mso-style-name:"cite";}
					.style17
						{mso-style-name:"col";}
					.style18
						{text-align:left;
						padding-left:54px;
						mso-char-indent-count:2;
						mso-style-name:"dir";}
					.style19
						{mso-number-format:"_ * \#\,\#\#0_ \;_ * \\-\#\,\#\#0_ \;_ * \0022-\0022_ \;_ \@_ ";
						mso-style-name:"Comma[0]";
						mso-style-id:6;}
					.style20
						{text-align:center;
						mso-style-name:"center";}
					.style21
						{mso-number-format:"_ * \#\,\#\#0\.00_ \;_ * \\-\#\,\#\#0\.00_ \;_ * \0022-\0022??_ \;_ \@_ ";
						mso-style-name:"Comma";
						mso-style-id:3;}
					.style22
						{mso-style-name:"@page";}
					.style23
						{font-weight:700;
						mso-style-name:"strong";}
					.style24
						{text-align:left;
						padding-left:54px;
						mso-char-indent-count:2;
						mso-style-name:"ol";}
					.style25
						{text-align:left;
						padding-left:54px;
						mso-char-indent-count:2;
						mso-style-name:"dd";}
					.style26
						{mso-style-name:"br";}
					.style27
						{font-style:italic;
						mso-style-name:"var";}
					.style28
						{font-weight:700;
						mso-style-name:"b";}
					.style29
						{mso-style-name:"table";}
					.style30
						{font-style:italic;
						mso-style-name:"em";}
					.style31
						{mso-style-name:"sub";}
					.style32
						{mso-number-format:"_ \0022\00A5\0022* \#\,\#\#0\.00_ \;_ \0022\00A5\0022* \\-\#\,\#\#0\.00_ \;_ \0022\00A5\0022* \0022-\0022??_ \;_ \@_ ";
						mso-style-name:"Currency";
						mso-style-id:4;}
					.style33
						{mso-number-format:"General";
						text-align:general;
						vertical-align:bottom;
						white-space:nowrap;
						color:windowtext;
						font-size:12.0pt;
						font-style:normal;
						text-decoration:none;
						font-family:宋体;
						mso-protection:locked visible;
						mso-style-name:"td";}
					.style34
						{font-style:italic;
						mso-style-name:"i";}
					.style35
						{text-line-through:single;
						mso-style-name:"del";}
					.style36
						{text-line-through:single;
						mso-style-name:"strike";}
					.style37
						{mso-number-format:"General";
						text-align:general;
						vertical-align:bottom;
						white-space:nowrap;
						color:windowtext;
						font-size:12.0pt;
						font-style:normal;
						text-decoration:none;
						font-family:宋体;
						mso-protection:locked visible;
						mso-style-name:".style1";}
					.style38
						{text-align:center;
						font-weight:700;
						mso-style-name:"th";}
					.style39
						{text-align:left;
						padding-left:54px;
						mso-char-indent-count:2;
						mso-style-name:"menu";}
					.style40
						{text-line-through:single;
						mso-style-name:"s";}
					.style41
						{mso-style-name:"sup";}
					.style42
						{text-decoration:underline;
						text-underline-style:single;
						mso-style-name:"u";}
					.style43
						{text-align:left;
						padding-left:54px;
						mso-char-indent-count:2;
						mso-style-name:"ul";}
					.style44
						{mso-style-name:"tr";}
					.style45
						{mso-number-format:"0%";
						mso-style-name:"Percent";
						mso-style-id:5;}
					.style46
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h1";}
					.style47
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h2";}
					.style48
						{font-style:italic;
						mso-style-name:"address";}
					.style49
						{mso-number-format:"_ \0022\00A5\0022* \#\,\#\#0_ \;_ \0022\00A5\0022* \\-\#\,\#\#0_ \;_ \0022\00A5\0022* \0022-\0022_ \;_ \@_ ";
						mso-style-name:"Currency[0]";
						mso-style-id:7;}
					.style50
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h3";}
					.style51
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h4";}
					.style52
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h5";}
					.style53
						{text-align:left;
						font-size:12.0pt;
						font-weight:700;
						mso-style-name:"h6";}
					td
						{mso-style-parent:style0;
						padding-top:1px;
						padding-right:1px;
						padding-left:1px;
						mso-ignore:padding;
						mso-number-format:"General";
						text-align:general;
						vertical-align:bottom;
						white-space:nowrap;
						mso-rotate:0;
						mso-pattern:auto;
						mso-background-source:auto;
						color:windowtext;
						font-size:12.0pt;
						font-weight:400;
						font-style:normal;
						text-decoration:none;
						font-family:宋体;
						mso-generic-font-family:auto;
						mso-font-charset:134;
						border:none;
						mso-protection:locked visible;}
					.xl55
						{mso-style-parent:style0;
						white-space:normal;}
					.xl56
						{mso-style-parent:style0;
						mso-number-format:"yyyy\\-mm\\-dd\\ HH:mm:ss";
						white-space:normal;}
					 -->  
				</style>
				<!--[if gte mso 9]><xml>
				 <x:ExcelWorkbook>
				  <x:ExcelWorksheets>
				   <x:ExcelWorksheet>
					<x:Name>srirmam</x:Name>
					<x:WorksheetOptions>
					 <x:Selected/>
					 <x:ProtectContents>False</x:ProtectContents>
					 <x:ProtectObjects>False</x:ProtectObjects>
					 <x:ProtectScenarios>False</x:ProtectScenarios>
					</x:WorksheetOptions>
				   </x:ExcelWorksheet>
				  </x:ExcelWorksheets>
				  <x:WindowHeight>10005</x:WindowHeight>
				  <x:WindowWidth>10005</x:WindowWidth>
				  <x:WindowTopX>120</x:WindowTopX>
				  <x:WindowTopY>135</x:WindowTopY>
				  <x:ProtectStructure>False</x:ProtectStructure>
				  <x:ProtectWindows>False</x:ProtectWindows>
				 </x:ExcelWorkbook>
				</xml><![endif]-->
				</head>

				<body link=blue vlink=purple>
				<table x:str border=0 cellpadding=0 cellspacing=0 style="border-collapse: collapse;table-layout:fixed;">
EOH;
        return $header;
    }

	function GetFooter()
    {
        return "</table></body></html>";
    }

    function addRow ($array) {
        // initialize all cells for this row
        $cells = "<tr>";
        // foreach key -> write value into cells
        foreach ($array as $k => $v){
			if(is_array($v)){
				$type = $v[1];
				$val = $v[0];
			}else{
				$type = 'str';
				$val = $v;
			}
			
            $cells .= "<td class=xl24 x:{$type} >" . $val . "</td>";
			unset($val);
			unset($type);
        }
		$cells .= "</tr>";
        // transform $cells content into one row
        $this->lines[] =$cells;

    }

    /**
     * Add an array to the document
     * 
     * This should be the only method needed to generate an excel
     * document.
     * 
     * @access public
     * @param array 2-dimensional array
     * @todo Can be transfered to __construct() later on
     */
    function addArray ($array) {

        // run through the array and add them into rows
        foreach ($array as $k => $v):
            $this->addRow ($v);
        endforeach;

    }

    /**
     * Generate the excel file
     * 
     * Finally generates the excel file and uses the header() function
     * to deliver it to the browser.
     * 
     * @access public
     * @param string $filename Name of excel file to generate (...xls)
     */
    function generateXML ($filename) {
		$filename = iconv('UTF-8', 'GBK//IGNORE', $filename);
        // deliver header (as recommended in php manual)
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: inline; filename=\"" . $filename . ".xls\"");
        // print out document to the browser
        // need to use stripslashes for the damn ">"
        echo stripslashes ($this->header);
        echo implode ("\n", $this->lines);
        echo $this->footer;

    }

}


?>