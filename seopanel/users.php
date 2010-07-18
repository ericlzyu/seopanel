<?php

/***************************************************************************
 *   Copyright (C) 2009-2011 by Geo Varghese(www.seopanel.in)  	   *
 *   sendtogeo@gmail.com   												   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   (at your option) any later version.                                   *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.,                                       *
 *   59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.             *
 ***************************************************************************/

include_once("includes/sp-load.php");
if( ($_GET['sec'] == 'my-profile') || ($_POST['sec'] == 'updatemyprofile')){
	isLoggedIn();
}else{
	checkAdminLoggedIn();
}
include_once(SP_CTRLPATH."/user.ctrl.php");
include_once(SP_CTRLPATH."/website.ctrl.php");
include_once(SP_CTRLPATH."/keyword.ctrl.php");
$controller = New UserController();
$controller->view->menu = 'users';
$controller->layout = 'ajax';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	switch($_POST['sec']){
		case "create":
			$controller->createUser($_POST);
			break;
			
		case "update":
			$controller->updateUser($_POST);
			break;
			
		case "updatemyprofile":
			$controller->updateMyProfile($_POST);
			break;
	}
	
}else{
	switch($_GET['sec']){
		
		case "Activate":
			$controller->__changeStatus($_GET['userId'], 1);			
			$controller->listUsers('ajax');
			break;
		
		case "Inactivate":
			$controller->__changeStatus($_GET['userId'], 0);
			$controller->listUsers('ajax');
			break;
		
		case "delete":
			$controller->__deleteUser($_GET['userId']);
			$controller->listUsers('ajax');
			break;
		
		case "edit":
			$controller->editUser($_GET['userId']);
			break;		
		
		case "new":
			$controller->newUser();
			break;
			
		case "my-profile":
			$controller->showMyProfile();
			break;

		default:
			$controller->listUsers($_GET['layout']);
			break;
	}
}

?>