# Statenweb Dogs Project

## Overview
This project is a WordPress application built using Bedrock, localwp for wordpress development setup, Tailwind CSS, Jquery for styling and Advanced Custom Fields (ACF) for managing dog data.

## Features
I implemented the following features for the Statenweb Dogs project:

- **Homepage (`front-page.php`)**: Displays dogs with current month (March) birthdays (e.g., Bailey and Lucy), including their names, images, birthdates, favorite food, toys, and allergies. Each dog’s name and image are clickable, linking to their individual pages.
- **All Dogs Page (`page-all-dogs.php`)**: Lists all dogs, with the oldest dog (Rex) featured. Includes filters for breed and allergies, allowing users to sort the list. Each dog is clickable, linking to its individual page.
- **Single Dog Pages (`single-dogs.php`)**: Provides detailed information for each dog (e.g., `/dog/charlie/`), including a “Back to All Dogs” button for easy navigation.
- **Navigation and Footer**: Added a navigation bar (`header.php`) and a styled footer (`footer.php`) that appear consistently across all pages, with proper alignment and design.
- **Custom Post Type (CPT)**: Registered a `dog` CPT in `functions.php` to manage dog data, with fields for name, owner name, birthdate, favorite food, toys, and allergies, using ACF.
- **Data Import Script (`import-dogs.php`)**: Created a script to import 19 unique dogs into the database, ensuring no duplicates and proper data population.
- **Styling with Tailwind CSS**: Used Tailwind CSS for responsive and modern styling, including grids, cards, and buttons.
  
## Screenshots
### Home Page
![home](https://github.com/user-attachments/assets/fcf9faf2-c29b-44da-bdb5-8e689502d65b)

### All dogs sorted
![all-dogs-sorted](https://github.com/user-attachments/assets/bfdeaee2-eb12-4dc3-9e15-ab15acb4d261)

### All dogs specific breed filter
![all-dogs-specific-breed](https://github.com/user-attachments/assets/920fc41b-1359-4b8a-888e-e3d62ff7f599)

## All dogs with allergies filter
![all-dogs-with-allergies-filter](https://github.com/user-attachments/assets/41e2ceab-64c5-4a1d-8517-ea13a2049dd4)

## Single dog
![singe-dog](https://github.com/user-attachments/assets/ddd641b5-11ef-4a00-baf7-54481fbbd6f4)

**Dog data in db**
![dog-data-db](https://github.com/user-attachments/assets/e6e8bfaf-8362-47c2-8501-c1df816a095d)




## Setup Instructions

### Prerequisites
- PHP 7.4 or higher
- Composer (for WordPress dependencies)
- Node.js and npm (for Tailwind CSS)
- Localwp (for wordpress development setup)

### Installation
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/your-username/statenweb-dogs.git
   cd statenweb-dogs
2. **Install Composer Dependencies**:
   ```bash
   composer install
   ```
   This installs WordPress core, Bedrock dependencies, and plugins (e.g., Advanced Custom Fields).
3. **Set Up Environment**:
   ```bash
   cp .env.example .env
   ```
   Edit it with your own credentials
4. **Install Node Dependencies:**:
   ```bash
   npm install
   ```
   Edit it with your own credentials
5. **Build Tailwind CSS**:
   ```bash
   npm run build
   ```
   This generates style.css in the theme folder. (web/app/themes/statenweb-dogs/).
6. **Import dog data**:
   Access http://your-site-url/import-dogs.php in the browser to import the 19 dogs into the dog custom post type.
