<?php

/**
 * The Administration loader for the module
 */
class ModuleAdmin extends Admin{

	/**
	 * The Default setup function
	 */
	public function ModuleAdmin($con){
		//Sets the unix name of the plugin
		$this->setUnix("FileManager");	
		
		//Set the controller
		$this->setController($con);
	}

	/**
	 * Default Requestion
	 */
	public function defaultRequest(){
		
		ob_start(); // start trapping output
		
		print $this->localize("The directory that this file manager defaults to is located at: /data/files.")."<br />";
		
		include "modules/FileManager/filemanagerbox.php"; // produce output
		$output = ob_get_contents(); // get contents of trapped output
		
		ob_end_clean(); // discard trapped output and stop trapping
		
		$this->setContent($output);
	}
}

?>