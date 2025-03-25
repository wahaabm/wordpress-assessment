<?php
require_once('./wp/wp-load.php');

// Clear existing dogs
$existing_dogs = get_posts(['post_type' => 'dog', 'posts_per_page' => -1, 'fields' => 'ids']);
foreach ($existing_dogs as $dog_id) {
    wp_delete_post($dog_id, true);
}

// Define the 19 dogs from spreadsheet.
$dogs = [
    ['name' => 'Fido', 'birthdate' => '22/02/2019', 'owner_name' => 'Alan S.', 'favorite_food' => 'chicken', 'favorite_toy' => 'tennis ball', 'food_allergies' => 'Wheat', 'breed' => 'Akita'],
    ['name' => 'Penny', 'birthdate' => '01/01/2018', 'owner_name' => 'Merry J.', 'favorite_food' => 'bitties', 'favorite_toy' => 'rubber ducky', 'food_allergies' => '', 'breed' => 'Labrador'],
    ['name' => 'Lulu', 'birthdate' => '22/11/2018', 'owner_name' => 'Jeff J.', 'favorite_food' => 'canned tuna', 'favorite_toy' => 'bone', 'food_allergies' => 'Beef, Chicken', 'breed' => 'Labrador'],
    ['name' => 'Theo', 'birthdate' => '22/10/2011', 'owner_name' => 'Cindy W.', 'favorite_food' => 'chicken, pork', 'favorite_toy' => 'rope', 'food_allergies' => 'Eggs, Corn', 'breed' => 'Golden retriever'],
    ['name' => 'Woof', 'birthdate' => '22/09/2011', 'owner_name' => 'John D.', 'favorite_food' => 'veal treats', 'favorite_toy' => 'tennis ball', 'food_allergies' => '', 'breed' => 'Boxer'],
    ['name' => 'Rex', 'birthdate' => '14/10/2005', 'owner_name' => 'Jane D.', 'favorite_food' => 'blueberries', 'favorite_toy' => 'wooden stick', 'food_allergies' => 'Milk', 'breed' => 'Akita'],
    ['name' => 'Lucky', 'birthdate' => '15/09/2013', 'owner_name' => 'Martin L.', 'favorite_food' => 'sausage', 'favorite_toy' => 'squeaky toy', 'food_allergies' => 'Soy', 'breed' => 'Akita'],
    ['name' => 'Dina', 'birthdate' => '26/06/2010', 'owner_name' => 'Meggy M.', 'favorite_food' => 'watermelon', 'favorite_toy' => 'tennis ball', 'food_allergies' => '', 'breed' => 'Golden retriever'],
    ['name' => 'Fluffy', 'birthdate' => '13/08/2012', 'owner_name' => 'Harry K.', 'favorite_food' => 'chicken', 'favorite_toy' => 'rubber hedgehog', 'food_allergies' => 'Milk', 'breed' => 'Golden retriever'],
    ['name' => 'Charlie', 'birthdate' => '11/06/2018', 'owner_name' => 'Ted K.', 'favorite_food' => 'sausage', 'favorite_toy' => 'rubber sausage', 'food_allergies' => '', 'breed' => 'French bulldog'],
    ['name' => 'Jack', 'birthdate' => '17/09/2012', 'owner_name' => 'Margo S.', 'favorite_food' => 'sausage', 'favorite_toy' => 'squeaky ball', 'food_allergies' => 'Eggs', 'breed' => 'Beagle'],
    ['name' => 'Daisy', 'birthdate' => '29/05/2017', 'owner_name' => 'Lena D.', 'favorite_food' => 'chicken', 'favorite_toy' => 'rubber donut', 'food_allergies' => '', 'breed' => 'Poodle'],
    ['name' => 'Bailey', 'birthdate' => '11/03/2016', 'owner_name' => 'Penelope C.', 'favorite_food' => 'carrot', 'favorite_toy' => 'tennis ball', 'food_allergies' => '', 'breed' => 'Akita'],
    ['name' => 'Buddy', 'birthdate' => '11/08/2015', 'owner_name' => 'Tom C.', 'favorite_food' => 'fish, chicken', 'favorite_toy' => 'paper towels', 'food_allergies' => 'Wheat', 'breed' => 'Akita'],
    ['name' => 'Ruby', 'birthdate' => '26/06/2019', 'owner_name' => 'Stanley K.', 'favorite_food' => 'canned chicken', 'favorite_toy' => 'frisby', 'food_allergies' => 'Wheat', 'breed' => 'Boxer'],
    ['name' => 'Oscar', 'birthdate' => '12/04/2015', 'owner_name' => 'Sandra B.', 'favorite_food' => 'bitties', 'favorite_toy' => 'rope', 'food_allergies' => '', 'breed' => 'French bulldog'],
    ['name' => 'Lucy', 'birthdate' => '15/03/2011', 'owner_name' => 'Johnny R.', 'favorite_food' => 'raspberries', 'favorite_toy' => 'rope', 'food_allergies' => '', 'breed' => 'French bulldog'],
    ['name' => 'Coco', 'birthdate' => '22/07/2017', 'owner_name' => 'Michelle P.', 'favorite_food' => 'chicken, tuna', 'favorite_toy' => 'tennis ball', 'food_allergies' => 'Beef', 'breed' => 'Labrador'],
    ['name' => 'Archie', 'birthdate' => '19/07/2016', 'owner_name' => 'Jenna J.', 'favorite_food' => 'salmon', 'favorite_toy' => 'bone', 'food_allergies' => 'Soy', 'breed' => 'Labrador'],
];

foreach ($dogs as $dog) {
    $post_id = wp_insert_post([
        'post_title' => $dog['name'],
        'post_type' => 'dog',
        'post_status' => 'publish',
    ]);

    if ($post_id) {
        $birthdate = DateTime::createFromFormat('d/m/Y', $dog['birthdate']);
        $acf_date = $birthdate ? $birthdate->format('Ymd') : '';
        update_field('name', $dog['name'], $post_id);
        update_field('birthdate', $acf_date, $post_id);
        update_field('owner_name', $dog['owner_name'], $post_id);
        update_field('favorite_food', $dog['favorite_food'], $post_id);
        update_field('favorite_toy', $dog['favorite_toy'], $post_id);
        update_field('food_allergies', $dog['food_allergies'], $post_id);
        update_field('breed', $dog['breed'], $post_id);
    }
}

echo "Dogs imported successfully!";
