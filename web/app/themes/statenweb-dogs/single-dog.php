<?php get_header(); ?>

<div class="container mx-auto p-4">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="dog-details p-4 border rounded bg-gray-50">
                <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
                <?php
                $dog_image = get_field('dog_image') ?: 'https://via.placeholder.com/150';
                echo '<img src="' . esc_url($dog_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-48 h-48 object-cover mb-4">';
                ?>
                <p><strong>Birth Date:</strong> <?php echo esc_html(get_field('birthdate')); ?></p>
                <p><strong>Owner:</strong> <?php echo esc_html(get_field('owner_name')); ?></p>
                <p><strong>Favorite Food:</strong> <?php echo esc_html(get_field('favorite_food')); ?></p>
                <p><strong>Favorite Toy:</strong> <?php echo esc_html(get_field('favorite_toy')); ?></p>
                <p><strong>Food Allergies:</strong> <?php echo esc_html(get_field('food_allergies') ?: '-'); ?></p>
                <p><strong>Breed:</strong> <?php echo esc_html(get_field('breed')); ?></p>
            </div>
        <?php endwhile;
    else : ?>
        <p class="text-gray-600">Dog not found.</p>
    <?php endif; ?>
    <a href="<?php echo esc_url(get_permalink(get_page_by_path('all-dogs'))); ?>" class="text-blue-500 hover:underline mt-4 inline-block">Back to All Dogs</a>
</div>

<?php get_footer(); ?>