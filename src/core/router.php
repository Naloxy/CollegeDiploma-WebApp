<?php

use scr\core\models\Items;
use src\core\models\Users;
use src\core\controllers\Controller;

Controller::view('/', 'home');
Controller::view('/catalog', 'catalog');
Controller::view('/newslist', 'newslist');
Controller::view('/news', 'news');
Controller::view('/cart', 'cart');
Controller::view('/login', 'login');
Controller::view('/reg', 'reg');
Controller::view('/category', 'category');
Controller::view('/item', 'item');
Controller::view('/services', 'services');
Controller::view('/latestnews', 'latestnews');
Controller::view('/forum', 'forum');
Controller::view('/post', 'post');
Controller::view('/profile', 'profile');
Controller::view('/thankyou', 'thankyou');
Controller::view('/post/create', 'post-create');
Controller::view('/post/redact', 'post-redact');

Controller::view('/admin', 'admin/admin');
Controller::view('/admin/items', 'admin/adminItems');
Controller::view('/admin/allnews', 'admin/adminNews');
Controller::view('/admin/types', 'admin/adminTypes');
Controller::view('/admin/item', 'admin/admin-item');
Controller::view('/admin/type', 'admin/admin-type');
Controller::view('/admin/news', 'admin/admin-news');

Controller::myPost('/updateItem', Items::class, 'updateItem');
Controller::myPost('/updateType', Items::class, 'updateType');
Controller::myPost('/updateNews', Items::class, 'updateNews');
Controller::myPost('/updateImage', Items::class, 'updateImage');
Controller::myPost('/updatePost', Items::class, 'updatePost');
Controller::myPost('/updateImageType', Items::class, 'updateImageType');
Controller::myPost('/updateImageNews', Items::class, 'updateImageNews');
Controller::myPost('/updateImagePost', Items::class, 'updateImagePost');
Controller::myPost('/addItem', Items::class, 'addItem');
Controller::myPost('/addType', Items::class, 'addType');
Controller::myPost('/addNews', Items::class, 'addNews');
Controller::myPost('/addPost', Items::class, 'addPost');
Controller::myPost('/deleteItem', Items::class, 'deleteItem');
Controller::myPost('/deleteType', Items::class, 'deleteType');
Controller::myPost('/deleteNews', Items::class, 'deleteNews');
Controller::myPost('/deletePost', Items::class, 'deletePost');
Controller::myPost('/postComment', Items::class, 'postComment');
Controller::myPost('/makeOrder', Items::class, 'makeOrder');
Controller::myPost('/updateStatus', Items::class, 'updateStatus');

Controller::myPost('/registration/add', Users::class, 'registration');
Controller::myPost('/login/get', Users::class, 'login');
Controller::myPost('/updateUserPassword', Users::class, 'updateUserPassword');
Controller::myPost('/updateUserData', Users::class, 'updateUserData');
Controller::myPost('/quit', Users::class, 'quit');



Controller::getContents();