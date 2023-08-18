# Notification Firebase Twilio Email Package

<p align="center">
    Simplify and streamline sending notifications through Firebase Cloud Messaging, Twilio SMS, and Email.
</p>

<p align="center">
    <a href="https://github.com/akshita2398/notification-firebase-twilio-email-package"><strong>GitHub Repository »</strong></a>
</p>

## Table of Contents

-   [Introduction](#introduction)
-   [Features](#features)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Configuration](#configuration)
-   [Contributing](#contributing)
-   [License](#license)

## Introduction

Welcome to the **Notification Firebase Twilio Email Package**! This package provides a seamless way to send various types of notifications – such as text messages, SMS, and emails – to users through Firebase Cloud Messaging, Twilio SMS, and Laravel's built-in email capabilities. With this package, you can effortlessly engage with your users using their preferred communication channels.

## Features

-   Send notifications using Firebase Cloud Messaging to reach users' mobile devices.
-   Utilize Twilio SMS functionality to deliver short messages to users' phones.
-   Leverage Laravel's native email support to send detailed notifications via email.
-   Customize and configure your notifications to suit your application's needs.

## Installation

To start using the **Notification Firebase Twilio Email Package**, follow these steps:

1. Install the package via Composer:

    ```bash
    composer require akshita/notification-firebase-twilio-email-package
    ```

2. In your Laravel project's `config/app.php`, add the service provider:

```php
'providers' => [
    // ...
    
    Akshita\NotificationFirebaseTwilioEmailPackage\Providers\NotificationServiceProvider::class,
],
```

## Usage

Sending notifications is a breeze with the **Notification Firebase Twilio Email Package**. Here's how you can use it in your Laravel application:

```php
use Akshita\NotificationFirebaseTwilioEmailPackage\Notification;

// Test this package by
Notification::test();

// Send a Firebase Cloud Messaging notification
$recipient = 'user@example.com';
$message = 'Hello from Firebase Cloud Messaging!';
$result = Notification::sendFirebaseMessage($recipient, $message);
if ($result) {
    // Notification sent successfully.
} else {
    // Notification sending failed.
}


// Send a Twilio SMS notification
$recipient = '+1234567890';
$message = 'Hello from Twilio SMS!';
Notification::sendTwilioSMS($recipient, $message);

// Send an email notification
$recipient = 'user@example.com';
$subject = 'Important Update';
$message = 'Hello from Email Notification!';
Notification::sendEmail($recipient, $subject, $message);
```

## Configuration

Configure your notification options by modifying the `config/notification.php` file in your Laravel app. Customize settings such as API credentials, sender information, and more to fit your needs.

## Contributing

Contributions are welcome! If you encounter issues or want to propose enhancements, please open an issue or submit a pull request on GitHub.

## License

This package is open-source software licensed under the [MIT License](LICENSE.md).
