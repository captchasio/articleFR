<?php
/*************************************************************************************************************************
*
* Free Reprintables Article Directory System
* Copyright (C) 2014  Glenn Prialde

* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.

* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
* 
* Author: Glenn Prialde
* Contact: admin@freecontentarticles.com
* Mobile: +639473473247	
*
* Website: http://freereprintables.com 
* Website: http://www.freecontentarticles.com 
*
*************************************************************************************************************************/

class Author extends Controller {

	function index() {}
	
	function v($_param_i)
	{
		$pagination = new Pagination();
		$page = isset($_REQUEST['page']) ? ((int) $_REQUEST['page']) : 1;
		$pagination->setCurrent($page);
		$pagination->setTarget($GLOBALS['base_url'] . 'author/v/' . $_param_i);
		$pagination->setRPP(15);
		
		$_site = $this->loadModel('site');
		$_view = $this->loadView('author');
		$_video = $this->loadModel('video');
		$this->loadPlugins($_site);
		
		$_site->init();
		
		$_site->connect();
		$_penname_profile = apply_filters('get_penname_by_name', decodeURL($_param_i), $_site->getConnection());
		$_profile = apply_filters('get_profile', $_penname_profile['username'], $_site->getConnection());
		$_profile['biography'] = apply_filters('the_biography', $_penname_profile['biography']);
		$_profile['gravatar'] = apply_filters('the_gravatar', $_penname_profile['gravatar']);
		$_profile['name'] = apply_filters('the_author', decodeURL($_param_i));
		$_recent = apply_filters('get_recent_by_author', decodeURL($_param_i), $_site->getConnection(), $pagination->getStart(), $pagination->getRPP());
		$_site->close();
		
		$_video->connect();	
		
		$_video->set( 'recent_videos', apply_filters('recent_videos', $_video->getConnection(), 0, 10) );
		$_video->set( 'channels', apply_filters('random_channels', $_video->getConnection()) );
		$_video->set( 'total_videos', apply_filters('get_total_videos', $_video->getConnection()) );

		$_video->close();		

		$_recent[0]['total'] = empty($_recent[0]['total']) ? 0 : $_recent[0]['total'];
		
		$pagination->setTotal($_recent[0]['total']);
		$_site->pagination = $pagination->parse();
		
		$_site->recent = $_recent;
		$_site->profile = apply_filters('the_profile_object', $_profile);
		
		$_site->set('title', apply_filters('the_site_title', str_replace('And', 'and', decodeURL($_param_i)) . ' Site Profile'));
		$_site->set('description', apply_filters('the_site_description', null));
		$_site->set('keywords', apply_filters('the_meta_keys', null));

		$_site->set_canonical(apply_filters('the_canonical', $GLOBALS['base_url'] . 'author/v/' . $_param_i));
		
		$_site->controller = 'author';
		
		$_view->set('site', apply_filters('the_site_object', $_site));
		$_view->set('_author_name_encoded', $_param_i);
		$_view->set('video', apply_filters('the_video_object', $_video));
		
		$_view->render();
	}

}

?>