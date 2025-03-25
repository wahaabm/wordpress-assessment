<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Navbar -->
    <header class="bg-gray-200 text-black">
        <nav class="container mx-auto p-4 flex justify-start space-x-4">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-gray-800">Home</a>
            <a href="<?php echo home_url('/all-dogs/'); ?>" class="hover:text-gray-800">All Dogs</a>
        </nav>
    </header>
    <main class="min-h-screen">