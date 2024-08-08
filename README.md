Here's the updated README file with the addition of Solidity smart contracts for bids:

---

# Listings & Bids App

## Overview

This project is a web application built using Laravel 11, Vue 3, and Inertia.js. The application is designed to allow users to create and manage listings, as well as place bids on these listings. Additionally, users can connect their cryptocurrency wallets to pay for bids and publish new listings, providing a modern and secure payment option. The app leverages Solidity smart contracts to handle bidding processes on the blockchain, ensuring transparency and security. The application combines the power of Laravel for backend logic, Vue 3 for dynamic frontend interactions, and Inertia.js for seamless page transitions without the need for a traditional SPA setup.

## Features

- **User Authentication**: Secure user registration and login system using Laravel's authentication scaffolding.
- **Listings Management**: Users can create, edit, and delete listings. Each listing can contain details such as a title, description, starting price, and an image.
- **Bidding System**: Registered users can place bids on active listings. The bidding system uses Solidity smart contracts, ensuring that all bid transactions are secure, transparent, and immutable on the blockchain.
- **Cryptocurrency Integration**: Users can connect their crypto wallets to pay for bids and publish new listings, offering flexibility and security in transactions.
- **Real-Time Notifications**: Users receive notifications when they are outbid or when the auction ends.
- **Responsive Design**: The app is fully responsive, ensuring a smooth experience across all devices.

## Technologies Used

- **Laravel 11**: A PHP framework used for backend logic, routing, and database management.
- **Vue 3**: A progressive JavaScript framework used for building user interfaces.
- **Inertia.js**: A modern stack that allows for building single-page applications (SPAs) without writing an API.
- **Solidity**: A smart contract programming language used for implementing the bidding system on the Ethereum blockchain.
- **Tailwind CSS**: A utility-first CSS framework used for designing the UI.
- **MySQL/PostgreSQL**: The database management system used for storing listings, bids, and user data.
- **Crypto Wallet Integration**: Support for cryptocurrency transactions, enabling users to pay for bids and listings securely.

## Installation

1. **Clone the Repository**
    ```bash
    git clone https://git@github.com:r0bchain/listings.git
    cd listings-bids-app
    ```

2. **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3. **Set Up Environment Variables**
    - Copy the `.env.example` file to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Set up your database, cryptocurrency wallet configurations, blockchain settings, and other necessary settings in the `.env` file.

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**
    ```bash
    php artisan migrate
    ```


6. **Build Frontend Assets**
    ```bash
    npm run build
    ```

7. **Deploy Smart Contracts**
    - Deploy the Solidity smart contracts to your preferred Ethereum network (e.g., Rinkeby for testing or Mainnet for production).
    - Update your `.env` file with the smart contract addresses and ABI files.

8. **Serve the Application**
    ```bash
    php artisan serve
    ```

9. **Access the Application**
    - Open your browser and navigate to `http://localhost:8000`.
  
10. ## Running the Seeders

To populate your database with initial data, you can run the seeders provided in this project. Follow these steps:

    1. **Navigate to your project directory**:
       Open your terminal and navigate to the root directory of your project.
    
       ```sh
       cd /path/to/your/project
        ```bash
       php artisan migrate:refresh --seed
       ```

---

### Image Storage Using IPFS and Pinata

This application utilizes the [Pinata](https://pinata.cloud/) service to leverage the InterPlanetary File System (IPFS) protocol for storing images. IPFS is a decentralized storage system that allows files to be stored and shared across a distributed network. By using IPFS, the application ensures that images related to listings and bids are securely stored in a way that is both resilient and accessible.

**Why Pinata?**  
Pinata is a service that provides an easy-to-use interface for uploading and managing files on the IPFS network. It abstracts away much of the complexity involved in interacting with IPFS directly, offering a reliable API for our application to handle image uploads seamlessly.

**How It Works:**  
- When a user uploads an image (for example, as part of a new listing), the application sends the image to Pinata.
- Pinata uploads the image to the IPFS network and returns a unique IPFS hash.
- This IPFS hash is stored in the application's database and is used to retrieve the image from the IPFS network whenever needed.

By using Pinata and IPFS, the application benefits from decentralized and persistent storage, ensuring that the images remain accessible and unaltered over time.

---

## Usage

- **Creating a Listing**: After logging in, users can create a new listing by navigating to the "Create Listing" page, filling out the form, and submitting it.
- **Placing a Bid**: Users can browse available listings and place bids on those of interest. The bidding process is securely handled via Solidity smart contracts on the blockchain.
- **Cryptocurrency Payments**: Users can connect their crypto wallets to pay for bids and to publish new listings. This feature allows for secure and fast transactions.
- **Managing Listings**: Users can view, edit, or delete their own listings from the "My Listings" section.

## Contribution

If you want to contribute to this project, please fork the repository and submit a pull request. All contributions are welcome!

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

This updated README now includes the use of Solidity smart contracts for handling bids, further emphasizing the app's focus on secure and transparent transactions.
