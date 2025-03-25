<?php get_header(); ?>

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">March Birthdays</h1>

    <?php
    //Get current month
    $current_month = date('m');
    $args = [
        'post_type' => 'dog',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => 'birthdate',
                'value' => $current_month,
                'compare' => 'LIKE',
                'type' => 'CHAR',
            ],
        ],
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="p-4 border rounded bg-green-50">
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="block hover:bg-green-100 p-4 rounded">
                        <?php
                        $dog_image = get_field('dog_image') ?: 'https://placehold.co/600x400'; //Temporary placeholder
                        echo '<img src="' . esc_url($dog_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-32 h-32 object-cover mb-2">';
                        ?>
                        <h2 class="text-xl font-semibold text-green-800"><?php the_title(); ?></h2>
                        <p>Birth Date: <?php echo esc_html(get_field('birthdate')); ?></p>
                        <p>Favorite Food: <?php echo esc_html(get_field('favorite_food')); ?></p>
                        <p>Favorite Toy: <?php echo esc_html(get_field('favorite_toy')); ?></p>
                        <p>Allergies: <?php echo esc_html(get_field('food_allergies') ?: '-'); ?></p>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else : ?>
        <p class="text-gray-600">No dogs have birthdays in March.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>