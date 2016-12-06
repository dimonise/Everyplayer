<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['(ru|en)'] = 'main';
$route['(ru|en)/home/black'] = 'home/black';
$route['(ru|en)/home/light'] = 'home/black';
$route['(ru|en)/home/black/(.+)'] = "home/black/$2";
$route['(ru|en)/black/news/(.+)'] = "home/news_black/$2";
$route['(ru|en)/light/news/(.+)'] = "home/news_black/$2";
$route['(ru|en)/black/registration'] = "home/registration";
$route['(ru|en)/light/registration'] =  "home/registration";
$route['(ru|en)/black/login'] = "home/login";
$route['(ru|en)/light/login'] =  "home/login";
$route['(ru|en)/auth/checklogin'] =  "auth/checklogin";
$route['(ru|en)/black/players'] = "players/index";
$route['(ru|en)/light/players'] =  "players/index";
$route['(ru|en)/black/players/(.+)'] = "players/index/$2";
$route['(ru|en)/light/players/(.+)'] =  "players/index/$2";
$route['(ru|en)/black/player/search'] = "players/search";
$route['(ru|en)/light/player/search'] = "players/search";
$route['(ru|en)/black/player/search_gamers_games/(.+)'] = "players/search_gamers_games/$2";
$route['(ru|en)/light/player/search_gamers_games/(.+)'] = "players/search_gamers_games/$2";

$route['(ru|en)/black/gides'] = 'gides/black';
$route['(ru|en)/light/gides'] = 'gides/black';
$route['(ru|en)/black/gide/(.+)'] = "gides/search_games_gides/$2";
$route['(ru|en)/light/gide/(.+)'] = "gides/search_games_gides/$2";
$route['(ru|en)/black/gide_one/(.+)'] = 'gides/one/$2';
$route['(ru|en)/light/gide_one/(.+)'] = 'gides/one/$2';
$route['(ru|en)/black/clan/(.+)'] = 'clans/info/$2';
$route['(ru|en)/light/clan/(.+)'] = 'clans/info/$2';
$route['(ru|en)/black/recrute/(.+)'] = 'clans/recrute/$2';
$route['(ru|en)/light/recrute/(.+)'] = 'clans/recrute/$2';
$route['(ru|en)/black/members'] = 'clans/members_clan';
$route['(ru|en)/light/members'] = 'clans/members_clan';
$route['(ru|en)/black/members/(.+)'] = 'clans/members_clan/$2';
$route['(ru|en)/light/members/(.+)'] = 'clans/members_clan/$2';
$route['(ru|en)/black/clan_news/(.+)'] = "clans/news/$2";
$route['(ru|en)/light/clan_news/(.+)'] = "clans/news/$2";
$route['(ru|en)/black/news_clan/(.+)'] = "clans/news_one_black/$2";
$route['(ru|en)/light/news_clan/(.+)'] = "clans/news_one_light/$2";
$route['(ru|en)/black/search_clan'] = "clans/search";
$route['(ru|en)/light/search_clan'] = "clans/search";
$route['(ru|en)/black/search_clan/(.+)'] = "clans/search/$2";
$route['(ru|en)/light/search_clan/(.+)'] = "clans/search/$2";
$route['(ru|en)/black/clans/filtr/(.+)'] = "clans/filtr/$2";
$route['(ru|en)/light/clans/filtr/(.+)'] = "clans/filtr/$2";
$route['(ru|en)/black/clans/filtr'] = "clans/filtr";
$route['(ru|en)/light/clans/filtr'] = "clans/filtr";
$route['(ru|en)/black/my_clans/(.+)'] = "clans/my_clans/$2";
$route['(ru|en)/light/my_clans/(.+)'] = "clans/my_clans/$2";
$route['(ru|en)/black/my_clans'] = "clans/my_clans";
$route['(ru|en)/light/my_clans'] = "clans/my_clans";
$route['(ru|en)/black/tournament/(.+)'] = "tour/tournament/$2";
$route['(ru|en)/light/tournament/(.+)'] = "tour/tournament/$2";
$route['(ru|en)/black/tournaments'] = "tour/tournaments";
$route['(ru|en)/light/tournaments'] = "tour/tournaments";
$route['(ru|en)/black/tournament_each_to_each/(.+)'] = "tour/tournament_each/$2";
$route['(ru|en)/light/tournament_each_to_each/(.+)'] = "tour/tournament_each/$2";
$route['(ru|en)/black/tournament_match/(.+)'] = "tour/tournament_match/$2";
$route['(ru|en)/light/tournament_match/(.+)'] = "tour/tournament_match/$2";
$route['(ru|en)/black/tournament_out/(.+)'] = "tour/tournament_out/$2";
$route['(ru|en)/light/tournament_out/(.+)'] = "tour/tournament_out/$2";
$route['(ru|en)/black/privat_favorites/(.+)'] = "privat/favorites/$2";
$route['(ru|en)/light/privat_favorites/(.+)'] = "privat/favorites/$2";
$route['(ru|en)/black/privat_clans/(.+)'] = "privat/myclans/$2";
$route['(ru|en)/light/privat_clans/(.+)'] = "privat/myclans/$2";
$route['(ru|en)/black/privat_info/(.+)'] = "privat/info/$2";
$route['(ru|en)/light/privat_info/(.+)'] = "privat/info/$2";
$route['(ru|en)/black/privat_tour/(.+)'] = "privat/mytour/$2";
$route['(ru|en)/light/privat_tour/(.+)'] = "privat/mytour/$2";
$route['(ru|en)/black/privat_friends/(.+)'] = "privat/friends/$2";
$route['(ru|en)/light/privat_friends/(.+)'] = "privat/friends/$2";

$route['(ru|en)/black/create_clan/(.+)'] = "privat/creat_clan/$2";
$route['(ru|en)/light/create_clan/(.+)'] = "privat/creat_clan/$2";

$route['(ru|en)/black/create_news/(.+)'] = "clans/creat_news/$2";
$route['(ru|en)/light/create_news/(.+)'] = "clans/creat_news/$2";

$route['(ru|en)/black/faq'] = "main/faq";
$route['(ru|en)/light/faq'] = "main/faq";
$route['(ru|en)/black/about'] = "main/about";
$route['(ru|en)/light/about'] = "main/about";
$route['(ru|en)/black/rules'] = "main/rules";
$route['(ru|en)/light/rules'] = "main/rules";

$route['(ru|en)/black/privat_achievements/(.+)'] = "privat/achievements/$2";
$route['(ru|en)/light/privat_achievements/(.+)'] = "privat/achievements/$2";

$route['(ru|en)/black/privat_premium/(.+)'] = "privat/premium/$2";
$route['(ru|en)/light/privat_premium/(.+)'] = "privat/premium/$2";

$route['(ru|en)/black/chat'] = 'chat/index';
$route['(ru|en)/light/chat'] = 'chat/index';
$route['(ru|en)/black/chat/(.+)'] = 'chat/index/$2';
$route['(ru|en)/light/chat/(.+)'] = 'chat/index/$2';








$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
