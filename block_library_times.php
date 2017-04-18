<?php
class block_library_times extends block_base {
    public function init() {
        $this->title = get_string('library_times', 'block_library_times');
    }
	
	public function get_content() {
		if ($this->content !== null) {
		  return $this->content;
		}
	 
		$this->content = new stdClass;
		//remove unrequired elements and code that causes errors
		$content = file_get_contents('http://portal.solent.ac.uk/site-elements/templates/sub-templates/library-opening-hours-iframe-template-for-mycourse/library-opening-hours.aspx');		
		$content = str_replace('<link href="/site-elements/css/site-styles2.css" rel="stylesheet" type="text/css" />',"", $content);
		$content = str_replace('<link href="/site-elements/css/site-styles.css" rel="stylesheet" type="text/css" />',"", $content);					
		$content = str_replace('<script src="/WebResource.axd?d=i128VoJtYp5a3QfcsHdbjMb2lfd7MH6uE1mCXhb2uJ-jMBgO3g7cW0MDBaEb3LPnBhK0zUwf7AqT-Prdr0oTug-5EKe4gzDYs5jmKusperk1&amp;t=634976343818095796" type="text/javascript"></script><noscript><p>Browser does not support script.</p></noscript>',"", $content);
		$content = str_replace('theForm.submit = WebForm_SaveScrollPositionSubmit;',"", $content);		
		$content = str_replace('theForm.onsubmit = WebForm_SaveScrollPositionOnSubmit;',"", $content);
		$content = str_replace('<script src="/ScriptResource.axd?d=Vj7KwkszshaerC1sAgbpx81vmKpJmyvkMX1hpTuMqpA2EiQoOmVVsvFj9VZ6mHWOV09kaOTLj_Ktoei5reXponZ_5xCxrscEZ_zstlIsCrHO6NJmNz701rIXfPJGUnJx1Tu_Xqfr5TdEoeFtF2oAtgYghHEHnC5t9plRzY9vmm01&amp;t=ffffffff940d030f" type="text/javascript"></script><noscript><p>Browser does not support script.</p></noscript>',"", $content);
		$content = str_replace("<h3>Today's opening times</h3>","", $content);
		//replace relative urls with full path
		$content = str_replace('href="/library/essential-info/opening-hours/opening-hours.aspx">','href="http://portal.solent.ac.uk/library/essential-info/opening-hours/opening-hours.aspx" target="_blank">', $content);
		$content = str_replace('href="/library/services-for/warsash-students/opening-hours.aspx">','href="http://portal.solent.ac.uk/library/services-for/warsash-students/opening-hours.aspx" target="_blank">', $content);
		
		$this->content->text = $content;
			 
		return $this->content;
	}
}