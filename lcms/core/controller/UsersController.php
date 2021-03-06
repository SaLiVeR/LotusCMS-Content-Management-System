<?php
class UsersController extends Controller{

	
	public function UsersController($page){
		//Setup the page
		$this->setup("Users", "Edit User", "admin", "Administrator");
	}

	protected function putRequests(){
		
		$requests = array(
					"create",
					"edit",
					"delete"
				);
		$this->setRequests($requests);
	}
	
	/**
	 * Show create page
	 */
	protected function createRequest(){
		$this->setState('CREATING_REQUEST');
		
		//Check if isset
		$d = $this->getModel()->getInputString("email", null, "P");
		
		//If the form was submitted
		if(!empty($d))
		{
			//Save user
			$save = $this->getModel()->saveUser(true);
			
			//Show Message
			$this->getView()->showSubmitMessage($save);
		}
		//Form was not submitted
		else
		{
			//Require Logged in user to be admistrator.
			$this->getModel()->requireAdministrator();
			
			//Do Stuff
			$this->getView()->showCreateForm();
		}
	}
	
	/**
	 * Show edit page
	 */
	protected function editRequest(){
		$this->setState('EDIT_REQUEST');
		
		//Check if isset
		$d = $this->getModel()->getInputString("access", null, "P");
		
		//If the Edit form was submitted
		if(!empty($d))
		{
			//Save user
			$save = $this->getModel()->saveUser(false);	
			
			//Show Message
			$this->getView()->showSubmitMessage($save);
		}
		//Otherwise show edit form
		else
		{
			//Gets the user details
			$data = $this->getModel()->getUserDetails();
			
			//Show Details in Form
			$this->getView()->showEditForm($data[0], $data[1], $data[2], $data[3], $data[4]);
		}
	}
	
	/**
	 * Show delete page
	 */
	protected function deleteRequest(){
		$this->setState('DELETE_REQUEST');
		
		//Check if isset
		$d = $this->getModel()->getInputString("acc");
		
		//If not accepted delete
		if(empty($d))
		{
			//Show Are you sure
			$this->getView()->showDeleteCheck($this->getModel()->getActiveRequest());
		}
		//Actually Delete the User
		else
		{
			//Delete User
			$this->getModel()->delete();
			
			//Show Delete Success Message
			$this->getView()->showDeleteSuccess($this->getModel()->getActiveRequest());
		}
	}
}

?>