<?php
require_once('example_api.php');

/**
 * Для получения:
 *     Пользователей: $api->users();
 *     
 *     Постов пользователя с id: $api->userPosts(2)
 * 
 *     Задач пользователя с id: $api->userTodos(2)
 * 
 * Для создания поста с id пользователя, заголовком(title) текстом(body):  $api->addPost(2, "Blablablas","Ablabibaboba")
 * 
 * Для редактирования поста с его id, заголовком(title) текстом(body): $api->editPost(2, "Blablablas", "Ablabibaboba")
 * 
 * Для удаления поста с его id: $api->deletePost(2)
 */

$api = new UseApi();


// echo '<pre>';
// print_r($api->users());
// echo '</pre>';

// echo '<pre>';
// print_r($api->userPosts(2));
// echo '</pre>';

// echo '<pre>';
// print_r($api->userTodos(2));
// echo '</pre>';

// echo '<pre>';
// print_r($api->addPost(2, "Blablablas","Ablabibaboba"));
// echo '</pre>';

// echo '<pre>';
// print_r($api->editPost(2, "Blablablas", "Ablabibaboba"));
// echo '</pre>';

// echo '<pre>';
// print_r($api->deletePost(2));
// echo '</pre>';
