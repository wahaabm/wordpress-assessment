<?php
get_header();
?>

<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-4">All Dogs</h1>

    <?php
    // Fetch all dogs sorted by birthdate, oldest first
    $args = [
        'post_type' => 'dog',
        'posts_per_page' => -1,
        'meta_key' => 'birthdate',
        'orderby' => 'meta_value',
        'order' => 'ASC'
    ];
    $query = new WP_Query($args);
    $dogs = [];
    $oldest_dog = null;

    while ($query->have_posts()) : $query->the_post();
        $birth_date = get_field('birthdate');
        $food_allergies = get_field('food_allergies');
        $dog_image = get_field('dog_image') ?: 'https://placehold.co/600x400'; // Temporary place holder.
        $dog = [
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'birth_date' => $birth_date,
            'owner_name' => get_field('owner_name'),
            'favorite_food' => get_field('favorite_food'),
            'favorite_toy' => get_field('favorite_toy'),
            'food_allergies' => $food_allergies,
            'breed' => get_field('breed'),
            'thumbnail' => '<img src="' . esc_url($dog_image) . '" alt="' . esc_attr(get_the_title()) . '" class="w-32 h-32 object-cover mb-2">'
        ];
        $dogs[] = $dog;
        if (!$oldest_dog || strtotime($birth_date) < strtotime($oldest_dog['birth_date'])) {
            $oldest_dog = $dog;
        }
    endwhile;
    wp_reset_postdata();

    usort($dogs, function ($a, $b) {
        return strtotime($a['birth_date']) - strtotime($b['birth_date']);
    });
    ?>

    <?php if ($oldest_dog): ?>
        <div class="featured-dog p-4 border rounded mb-8 bg-yellow-100">
            <h2 class="text-2xl font-bold text-yellow-800">
                <a href="<?php echo esc_url(get_permalink($oldest_dog['id'])); ?>" class="text-blue-600 hover:underline">
                    Our Oldest Dog:
                    <?php echo esc_html($oldest_dog['title']); ?>
                </a>
            </h2>
            <?php echo $oldest_dog['thumbnail']; ?>
            <p>Birth Date: <?php echo esc_html($oldest_dog['birth_date']); ?></p>
            <p>Owner: <?php echo esc_html($oldest_dog['owner_name']); ?></p>
            <p>Favorite Food: <?php echo esc_html($oldest_dog['favorite_food']); ?></p>
            <p>Favorite Toy: <?php echo esc_html($oldest_dog['favorite_toy']); ?></p>
            <p>Food Allergies: <?php echo esc_html($oldest_dog['food_allergies'] ?: '-'); ?></p>
            <p>Breed: <?php echo esc_html($oldest_dog['breed']); ?></p>
        </div>
    <?php endif; ?>

    <div class="filters mb-4 flex space-x-4">
        <select id="breed-filter" class="p-2 border rounded">
            <option value="">All Breeds</option>
            <?php
            $breeds = array_unique(array_map(function ($dog) {
                return $dog['breed'];
            }, $dogs));
            foreach ($breeds as $breed) {
                echo '<option value="' . esc_attr(strtolower($breed)) . '">' . esc_html($breed) . '</option>';
            }
            ?>
        </select>
        <label class="flex items-center">
            <input type="checkbox" id="allergy-filter" class="mr-2"> Show Only Dogs with Food Allergies
        </label>
    </div>

    <div id="dogs-list" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($dogs as $dog): if ($dog['id'] === $oldest_dog['id']) continue; ?>
            <div class="dog-card p-4 border rounded"
                data-breed="<?php echo esc_attr(strtolower($dog['breed'])); ?>"
                data-allergy="<?php echo !empty($dog['food_allergies']) ? 'yes' : 'no'; ?>">
                <a href="<?php echo esc_url(get_permalink($dog['id'])); ?>" class="block hover:bg-gray-100 p-4 rounded">
                    <?php echo $dog['thumbnail']; ?>
                    <h2 class="text-xl font-semibold"><?php echo esc_html($dog['title']); ?></h2>
                    <p>Birth Date: <?php echo esc_html($dog['birth_date']); ?></p>
                    <p>Owner: <?php echo esc_html($dog['owner_name']); ?></p>
                    <p>Favorite Food: <?php echo esc_html($dog['favorite_food']); ?></p>
                    <p>Favorite Toy: <?php echo esc_html($dog['favorite_toy']); ?></p>
                    <p>Food Allergies: <?php echo !empty($dog['food_allergies']) ? esc_html($dog['food_allergies']) : 'No'; ?></p>
                    <p>Breed: <?php echo esc_html($dog['breed']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
        function filterDogs() {
            const breed = $('#breed-filter').val();
            const showAllergy = $('#allergy-filter').is(':checked');
            $('.dog-card').each(function() {
                const matchesBreed = !breed || $(this).data('breed') === breed;
                const matchesAllergy = !showAllergy || $(this).data('allergy') === 'yes';
                $(this).toggle(matchesBreed && matchesAllergy);
            });
        }
        $('#breed-filter, #allergy-filter').on('change', filterDogs);
        filterDogs();
    });
</script>

<?php get_footer(); ?>