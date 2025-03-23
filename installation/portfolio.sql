-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 01:11 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `l_name`, `phone`, `email`, `image`, `password`, `status`, `remember_token`, `fcm_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Janam', 'Pandey', '+9779866077949', 'janampandey2@gmail.com', '2025-02-11-67ab3043027e3.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2023-09-30 04:31:25', '2025-03-02 05:33:00', 1),
(2, 'Prince', 'Yadav', '9813104240', 'prince@gmail.com', '2023-10-09-65241d9daf392.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2023-10-09 21:19:53', '2025-02-25 09:13:48', 5),
(5, 'Shristi', 'Shrestha', '9828367494', 'jananpandey1995@gmail.com', '2025-01-10-6780b2424a617.png', '$2y$10$q5mHXA4mgUct1bVoPpblTOJdIKafmV0CQy1RaR8MHLJoX25tBBjnq', 1, NULL, NULL, '2024-05-19 16:09:05', '2025-02-16 12:24:07', 5);

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `modules` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `modules`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', NULL, 1, NULL, NULL),
(5, 'Staff', '[\"attendance\",\"timesheet\",\"leave\",\"travelorder\"]', 1, '2025-01-08 09:19:46', '2025-03-02 05:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `category` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `blog_image` varchar(255) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_details` longtext NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `slug` varchar(255) NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `category`, `author_name`, `blog_image`, `blog_title`, `blog_details`, `status`, `slug`, `tags`, `created_at`, `updated_at`) VALUES
(7, 'learning', 'Janam Pandey', '2025-03-23-67dfe49fd9fc0.png', 'Building a Scalable Web Application with PHP, Laravel, MySQL, and Blade', '<p>Developing a scalable web application requires a solid tech stack. Laravel, combined with MySQL, Blade, and JavaScript, offers an efficient and flexible environment for building modern web applications. This blog explores key aspects of developing a Laravel-based web application, from database setup to performance optimization.</p>\r\n\r\n<h4><strong>1. Setting Up Laravel with MySQL</strong></h4>\r\n\r\n<p>Laravel seamlessly integrates with MySQL, making database interactions straightforward. The <code>.env</code> file contains database credentials, which Laravel uses to establish connections. Laravel migrations help structure and version-control database tables, ensuring smooth database management.</p>\r\n\r\n<h4><strong>2. Using Blade for Templating</strong></h4>\r\n\r\n<p>Blade, Laravel&rsquo;s templating engine, simplifies dynamic content rendering. With features like template inheritance, reusable components, and directives, developers can create modular and maintainable frontend views. The ability to pass data to Blade views allows for dynamic page generation, improving efficiency.</p>\r\n\r\n<h4><strong>3. Implementing AJAX with Laravel and JavaScript</strong></h4>\r\n\r\n<p>AJAX enhances user experience by enabling dynamic content updates without full-page reloads. Using JavaScript to send requests to Laravel controllers allows data retrieval and updates in real time. This is particularly useful for interactive features like live search, filtering, and content pagination.</p>\r\n\r\n<h4><strong>4. Optimizing Performance with Caching</strong></h4>\r\n\r\n<p>Caching reduces database queries and speeds up response times. Laravel provides various caching drivers, such as file-based caching, Redis, and database caching. By storing frequently accessed queries, developers can significantly improve application performance and scalability.</p>\r\n\r\n<h4><strong>5. Implementing Authentication with Laravel Breeze</strong></h4>\r\n\r\n<p>User authentication is a crucial aspect of web applications. Laravel Breeze provides a simple way to set up authentication, including user registration, login, and password reset. It integrates seamlessly with Laravel&rsquo;s authentication guards and policies, making it easy to implement secure user management.</p>\r\n\r\n<h4><strong>Conclusion</strong></h4>\r\n\r\n<p>Leveraging Laravel, MySQL, Blade, and JavaScript allows developers to build scalable and efficient web applications. From database management and templating to AJAX and caching, each component plays a vital role in creating a smooth user experience. Optimizing these technologies ensures a robust and high-performing application.</p>', 1, 'top-trends-in-web-design-and-development-for-2025', '#Laravel, #PHP, #MySQL, #Blade, #JavaScript, #AJAX, #Web Development, #Authentication, #Caching, #Performance Optimization', '2025-03-22 23:15:48', '2025-03-23 04:53:23'),
(8, 'tech_news', 'Janam Pandey', '2025-03-23-67dfd64d16a20.png', 'The Future of Web Development: Trends to Watch in 2025', '<p>The web development landscape is constantly evolving, with new technologies and frameworks emerging each year. In 2025, developers and businesses must stay ahead of trends to remain competitive. This blog explores the biggest shifts in web development that will shape the future.</p>\r\n\r\n<h3><strong>Key Web Development Trends for 2025</strong></h3>\r\n\r\n<h4><strong>1. AI and Machine Learning in Web Development</strong></h4>\r\n\r\n<p>Artificial Intelligence (AI) and Machine Learning (ML) are being integrated into web development to enhance user experience and automate tasks. AI-driven code generators like GitHub Copilot are helping developers write code faster, while ML-powered chatbots and recommendation engines provide personalized user experiences.</p>\r\n\r\n<h4><strong>2. Web3 &amp; Decentralization</strong></h4>\r\n\r\n<p>The internet is shifting towards decentralization with Web3, enabling users to have more control over their data. Blockchain-based applications, smart contracts, and decentralized finance (DeFi) platforms are becoming mainstream. Technologies like <strong>Ethereum, IPFS, and Solidity</strong> will gain more adoption in web development.</p>\r\n\r\n<h4><strong>3. Progressive Web Apps (PWAs) on the Rise</strong></h4>\r\n\r\n<p>PWAs combine the best of mobile apps and websites, providing faster performance, offline functionality, and push notifications. Businesses like <strong>Twitter Lite and Starbucks PWA</strong> have already embraced this, and more will follow in 2025.</p>\r\n\r\n<h4><strong>4. Serverless Computing</strong></h4>\r\n\r\n<p>Serverless architecture allows developers to run applications without managing backend servers. Cloud providers like <strong>AWS Lambda, Google Cloud Functions, and Azure Functions</strong> offer scalable solutions where developers pay only for the resources they use.</p>\r\n\r\n<h4><strong>5. Enhanced Cybersecurity</strong></h4>\r\n\r\n<p>As cyber threats increase, web developers must prioritize security measures. Key trends include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Implementing <strong>Zero Trust Architecture (ZTA)</strong></p>\r\n	</li>\r\n	<li>\r\n	<p>Using <strong>biometric authentication</strong></p>\r\n	</li>\r\n	<li>\r\n	<p>Encrypting sensitive data with <strong>Quantum Cryptography</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Keeping up with these trends will help developers create modern, secure, and scalable web applications. Embracing AI, Web3, PWAs, and enhanced cybersecurity will be key to staying relevant in the industry.</p>', 1, 'the-future-of-web-development-trends-to-watch-in-2025', '#WebDevelopment, #TechTrends, #AI, #MachineLearning, #Web3, #PWAs, #Cybersecurity, #Serverless', '2025-03-23 03:52:17', '2025-03-23 03:52:17'),
(9, 'general', 'Janam Pandey', '2025-03-23-67dfd75fe8349.png', 'How to Improve Website Performance: Best Practices for Developers', '<p>Website speed and performance play a crucial role in user experience and SEO rankings. A slow website can increase bounce rates and negatively impact conversions. Here are some proven strategies to optimize website performance.</p>\r\n\r\n<h3><strong>Best Practices to Improve Website Performance</strong></h3>\r\n\r\n<h4><strong>1. Optimize Images for Faster Loading</strong></h4>\r\n\r\n<p>Large images slow down websites. Use the following methods to optimize images:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Convert images to <strong>WebP format</strong> (smaller file size, better quality).</p>\r\n	</li>\r\n	<li>\r\n	<p>Implement <strong>lazy loading</strong> so images load only when needed.</p>\r\n	</li>\r\n	<li>\r\n	<p>Use tools like <strong>TinyPNG</strong> or <strong>ImageOptim</strong> for compression.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Minify CSS, JavaScript, and HTML</strong></h4>\r\n\r\n<p>Minifying code removes unnecessary characters, reducing file size and improving load time. Use tools like:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Terser</strong> (for JavaScript minification)</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>CSSNano</strong> (for CSS minification)</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>HTMLMinifier</strong> (for HTML minification)</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Use a Content Delivery Network (CDN)</strong></h4>\r\n\r\n<p>A CDN distributes website content across multiple servers worldwide, reducing load times. Popular CDNs include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Cloudflare</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Amazon CloudFront</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Akamai</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Enable Browser Caching</strong></h4>\r\n\r\n<p>Caching stores static resources like images, CSS, and JavaScript in the user&rsquo;s browser, so they don&rsquo;t have to be downloaded every time. Use cache-control headers to set expiration times.</p>\r\n\r\n<h4><strong>5. Optimize Database Queries</strong></h4>\r\n\r\n<p>If your site relies on a database (e.g., MySQL, PostgreSQL), optimize queries by:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Using indexes</strong> to speed up search operations.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Reducing redundant queries</strong> by caching database results.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Using database optimization tools</strong> like <strong>MySQL Query Cache</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>By implementing these optimization techniques, you can improve website performance, increase user engagement, and boost SEO rankings.</p>', 1, 'how-to-improve-website-performance-best-practices-for-developers', '#WebsitePerformance, #WebOptimization, #CDN, #LazyLoading, #Minification, #SEO, #PageSpeed', '2025-03-23 03:55:30', '2025-03-23 03:56:51'),
(10, 'learning', 'Janam Pandey', '2025-03-23-67dfe231725ad.png', 'A Beginner’s Guide to Building a Full-Stack Web Application', '<p>Full-stack web development involves both frontend (client-side) and backend (server-side) development. This guide walks you through creating a simple <strong>CRUD (Create, Read, Update, Delete) web application</strong> using <strong>React.js</strong> for the frontend and <strong>Node.js with Express</strong> for the backend.</p>\r\n\r\n<h3><strong>Step-by-Step Guide to Building a Full-Stack Web App</strong></h3>\r\n\r\n<h4><strong>Step 1: Choose Your Tech Stack</strong></h4>\r\n\r\n<p>For this project, we will use:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Frontend:</strong> React.js + Tailwind CSS</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Backend:</strong> Laravel</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Database:</strong> MySQL</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Authentication:</strong> JSON Web Token (JWT)</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>Step 2: Set Up the Backend</strong></h4>\r\n\r\n<p><strong>Step 3: Develop the Frontend</strong></p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Create a React app:&nbsp;</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; npx create-react-app my-app<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; cd my-app<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; npm start</p>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Fetch data from the backend using <strong>Axios</strong> or <strong>Fetch API</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p>Use <strong>React Router</strong> for navigation.</p>\r\n	</li>\r\n</ol>\r\n\r\n<h4><strong>Step 4: Add User Authentication</strong></h4>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Create JWT tokens for user login.</p>\r\n	</li>\r\n	<li>\r\n	<p>Store tokens securely using <strong>HTTP-only cookies</strong>.</p>\r\n	</li>\r\n</ol>\r\n\r\n<h4><strong>Step 5: Deploy the Application</strong></h4>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Deploy the <strong>frontend on Cpanel</strong>.</p>\r\n	</li>\r\n</ol>\r\n\r\n<p>By following these steps, you&rsquo;ll have a fully functional full-stack web app. Keep practicing to master full-stack development.</p>', 1, 'a-beginners-guide-to-building-a-full-stack-web-application', '#FullStackDevelopment, #ReactJS, #NodeJS, #ExpressJS, #MongoDB, #CRUDApp, #WebDevelopment', '2025-03-23 03:59:10', '2025-03-23 04:49:02'),
(11, 'general', 'Janam Pandey', '2025-03-23-67dfe2e2319ce.png', 'Why SEO Matters in Web Development: Key Optimization Strategies', '<p>SEO (Search Engine Optimization) helps websites rank higher on search engines, bringing more traffic and engagement. Developers must integrate SEO strategies during website development.</p>\r\n\r\n<h3><strong>Key SEO Optimization Strategies</strong></h3>\r\n\r\n<h4><strong>1. Mobile-First Design</strong></h4>\r\n\r\n<p>Google prioritizes mobile-friendly websites in search rankings. Ensure your website:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Uses <strong>responsive design</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p>Has <strong>fast-loading mobile pages</strong> (AMP).</p>\r\n	</li>\r\n	<li>\r\n	<p>Provides <strong>touch-friendly navigation</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Page Speed Optimization</strong></h4>\r\n\r\n<p>Google considers <strong>Core Web Vitals</strong> like <strong>Largest Contentful Paint (LCP), First Input Delay (FID), and Cumulative Layout Shift (CLS)</strong> for rankings. Optimize by:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Minimizing HTTP requests</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Reducing render-blocking resources</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Keyword Optimization</strong></h4>\r\n\r\n<p>Use relevant keywords in:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Meta titles and descriptions</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>URLs and alt texts</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Content and headings (H1, H2, H3)</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Schema Markup</strong></h4>\r\n\r\n<p>Schema markup helps search engines understand your content better. Use <strong>JSON-LD structured data</strong> for rich snippets.</p>\r\n\r\n<p>Integrating SEO strategies in web development ensures better search engine rankings and visibility.</p>', 1, 'why-seo-matters-in-web-development-key-optimization-strategies', '#SEO, #SearchEngineOptimization, #CoreWebVitals, #MobileFirst, #PageSpeed, #SchemaMarkup, #WebDev', '2025-03-23 04:45:58', '2025-03-23 04:45:58'),
(12, 'general', 'Janam Pandey', '2025-03-23-67dfe36c0c14a.png', 'The Best Web Development Tools & Frameworks in 2025', '<p>Developers use various tools and frameworks to streamline coding and improve efficiency. Here are the top web development tools and frameworks in 2025.</p>\r\n\r\n<h3><strong>Top Web Development Tools &amp; Frameworks</strong></h3>\r\n\r\n<h4><strong>1. Frontend Frameworks</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>React.js</strong> &ndash; Best for building dynamic UIs.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Vue.js</strong> &ndash; Lightweight and easy to integrate.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Svelte</strong> &ndash; Compiler-based, no virtual DOM.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Backend Frameworks</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Node.js + Express</strong> &ndash; Fast and scalable for JavaScript developers.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Django</strong> &ndash; Secure and scalable for Python developers.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Laravel</strong> &ndash; Feature-rich PHP framework.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Databases</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>MongoDB</strong> &ndash; NoSQL database for flexible data storage.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>PostgreSQL</strong> &ndash; Relational database with strong ACID compliance.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Version Control &amp; Deployment</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Git &amp; GitHub</strong> &ndash; For version control and collaboration.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Vercel &amp; Netlify</strong> &ndash; For easy frontend deployment.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Docker &amp; Kubernetes</strong> &ndash; For containerized deployment.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Choosing the right tools improves development efficiency and scalability. Stay updated with new frameworks to enhance your skillset.</p>', 1, 'the-best-web-development-tools-frameworks-in-2025', '#WebDevelopmentTools, #ReactJS, #Django, #Laravel, #NodeJS, #GitHub, #Docker, #Kubernetes', '2025-03-23 04:48:16', '2025-03-23 04:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `data_settings`
--

CREATE TABLE `data_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_settings`
--

INSERT INTO `data_settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'admin_login_url', 'admin', 'login_admin', '2023-06-20 16:55:51', '2023-06-20 16:55:51'),
(111, 'about', '<p>I am passionate about personal and professional growth and seek an organization that values continuous learning. My goal is to contribute to the organization&#39;s success by leveraging my skills and knowledge. With a collaborative mindset and dedication, I aim to work alongside the team to achieve common objectives and exceed expectations. I thrive on challenges and am eager to adapt to evolving landscapes, making a meaningful impact while enriching my own skill set. I am excited to be part of a growth-focused organization, applying this mindset to both company projects and personal projects provided to me.</p>\r\n\r\n<p>&nbsp;</p>', 'admin_landing_page', '2025-03-11 06:18:33', '2025-03-23 03:41:36'),
(112, 'about_image', '2025-03-17-67d7ff4373fb0.png', 'admin_landing_page', '2025-03-17 05:05:03', '2025-03-17 05:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `background_image` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `button_name` varchar(100) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `email_type` varchar(255) DEFAULT NULL,
  `email_template` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `body`, `background_image`, `image`, `logo`, `icon`, `button_name`, `button_url`, `footer_text`, `copyright_text`, `type`, `email_type`, `email_template`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Change Password Request', '<p>The following user has forgotten his password &amp; requested to change/reset their password.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>User Name: {userName}</strong></p>', NULL, NULL, NULL, '2025-02-27-67c028219789d.png', '', '', 'Please contact us for any queries; we’re always happy to help.', '© 2025 NACCFL. All rights reserved.', 'admin', 'forget_password', '5', 1, '2023-06-20 18:19:43', '2025-02-27 08:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`id`, `name`, `subject`, `email`, `contact`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Janam Pandey', 'Testing', 'janampandey2@gmail.com', '9866077949', 'Testing', '2025-03-21 05:03:23', '2025-03-21 05:03:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_05_081114_create_admins_table', 1),
(53, '2021_05_10_152713_create_business_settings_table', 10),
(134, '2021_07_13_133941_create_admin_roles_table', 44),
(137, '2021_07_14_110011_create_employee_roles_table', 46),
(212, '2021_12_22_114414_create_translations_table', 75),
(325, '2023_05_10_184114_create_data_settings_table', 87),
(329, '2023_05_18_161133_create_email_templates_table', 87),
(382, '2024_06_06_115927_create_storages_table', 91);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `otp_hit_count` tinyint(4) NOT NULL DEFAULT 0,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `is_temp_blocked` tinyint(1) NOT NULL DEFAULT 0,
  `temp_block_time` timestamp NULL DEFAULT NULL,
  `created_by` varchar(50) DEFAULT 'user',
  `phone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'def.png',
  `description` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resume_details`
--

CREATE TABLE `resume_details` (
  `id` bigint(20) NOT NULL,
  `resume_type` varchar(255) NOT NULL COMMENT 'ed - Education\r\nex - Experience',
  `title` varchar(255) NOT NULL COMMENT 'Degree Name / Designation',
  `date_range` varchar(255) NOT NULL,
  `name_address` varchar(255) NOT NULL COMMENT 'Name (College, Company) / Address',
  `details` varchar(500) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resume_details`
--

INSERT INTO `resume_details` (`id`, `resume_type`, `title`, `date_range`, `name_address`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ed', 'SEE', '2016-2017', 'Munal Academy, Gajuri Dhading', '<p>I completed with 3.75 GPA.</p>', 1, '2025-03-19 04:48:36', '2025-03-19 04:48:36'),
(3, 'ed', 'High School (+2)', '2017-2019', 'Kathmandu Model College, Bagbazar, Kathmandu', '<p>I completed my high school in Science Stream with overall GPA of 3.16.</p>', 1, '2025-03-21 05:52:08', '2025-03-21 05:52:08'),
(4, 'ed', 'Bachelor of Science in Information Technology (Bsc. IT)', '2019-2023', 'Lord Buddha Education Foundation (LBEF) in academic collaboration with Asia Pacific University of Technology & Innovation, Malaysia', '<p>I completed my bachelor degree with overall GPA of 3.38.</p>', 1, '2025-03-21 05:54:24', '2025-03-21 05:54:24');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL DEFAULT 'def.png',
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `description`, `status`, `created_at`, `updated_at`, `priority`, `slug`) VALUES
(1, 'Web Development', '2025-03-21-67dd5072eec98.png', 'Build your website with most experienced developer.', 1, '2025-03-11 02:19:29', '2025-03-21 05:56:38', 0, 'website-development'),
(2, 'Mobile Application Development', '2025-03-21-67dd504350621.png', 'testing', 1, '2025-03-20 01:49:20', '2025-03-21 05:55:51', 0, 'app-development2'),
(3, 'Software Development', '2025-03-21-67dd50dd4be3b.png', 'Best software development with clean and reusable code for best performance.', 1, '2025-03-21 05:58:25', '2025-03-21 05:58:25', 0, NULL),
(4, 'Digital Marketing', '2025-03-21-67dd512249ba5.png', 'For SEO', 1, '2025-03-21 05:59:34', '2025-03-21 05:59:34', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `image`, `rate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PHP-Laravel', '2025-03-19-67da58d0777a5.png', 80, 1, '2025-03-18 23:55:32', '2025-03-19 00:02:18'),
(3, 'jQuery', '2025-03-21-67dd4dd30ad1e.png', 60, 1, '2025-03-21 05:45:27', '2025-03-21 05:45:27'),
(4, 'HTML', '2025-03-21-67dd4e17913d6.png', 100, 1, '2025-03-21 05:46:35', '2025-03-21 05:46:35'),
(5, 'CSS', '2025-03-21-67dd4e52d24d1.png', 100, 1, '2025-03-21 05:47:34', '2025-03-21 05:47:34'),
(6, 'Core PHP', '2025-03-21-67dd4eae452bb.png', 80, 1, '2025-03-21 05:49:06', '2025-03-21 05:49:06'),
(7, 'Javascript', '2025-03-21-67dd4ed968f3d.png', 60, 1, '2025-03-21 05:49:49', '2025-03-21 05:49:49'),
(8, 'mySQL', '2025-03-21-67dd4effe72e2.png', 70, 1, '2025-03-21 05:50:27', '2025-03-21 05:50:27');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'facebook', 'https://www.facebook.com/janampandey12', 1, NULL, '2025-03-11 04:14:02'),
(2, 'linkedin', 'https://np.linkedin.com/in/janam-pandey-6bb571199', 1, NULL, '2025-03-11 04:14:53'),
(6, 'github', 'https://github.com/Janam22', 1, NULL, '2025-03-19 03:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `storages`
--

CREATE TABLE `storages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_type` varchar(255) NOT NULL,
  `data_id` varchar(100) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storages`
--

INSERT INTO `storages` (`id`, `data_type`, `data_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\BusinessSetting', '160', NULL, 'public', '2025-01-10 08:33:02', '2025-01-10 08:33:02'),
(10, 'App\\Models\\BusinessSetting', '118', NULL, 'public', '2024-12-31 10:12:57', '2024-12-31 10:12:57'),
(21, 'App\\Models\\BusinessSetting', '198', NULL, 'public', '2024-10-21 15:26:16', '2024-10-21 15:26:16'),
(22, 'App\\Models\\BusinessSetting', '199', NULL, 'public', '2024-10-21 15:26:16', '2024-10-21 15:26:16'),
(23, 'App\\Models\\BusinessSetting', '200', NULL, 'public', '2024-12-31 06:24:18', '2024-12-31 06:24:18'),
(24, 'App\\Models\\BusinessSetting', '196', NULL, 'public', '2025-01-28 05:41:21', '2025-01-28 05:41:21'),
(25, 'App\\Models\\BusinessSetting', '100', NULL, 'public', '2025-01-05 06:05:29', '2025-01-05 06:05:29'),
(26, 'App\\Models\\BusinessSetting', '79', NULL, 'public', '2025-01-05 06:06:19', '2025-01-05 06:06:19'),
(27, 'App\\Models\\BusinessSetting', '53', NULL, 'public', '2025-01-07 06:39:43', '2025-01-07 06:39:43'),
(28, 'App\\Models\\DataSetting', '108', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(29, 'App\\Models\\DataSetting', '109', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(30, 'App\\Models\\DataSetting', '110', NULL, 'public', '2025-01-07 06:07:10', '2025-01-07 06:07:10'),
(32, 'App\\Models\\Admin', '1', 'image', 'public', '2025-02-11 11:10:59', '2025-02-11 11:10:59'),
(33, 'App\\Models\\Admin', '5', 'image', 'public', '2025-01-10 05:38:10', '2025-01-10 05:38:10'),
(42, 'App\\Models\\EmailTemplate', '1', 'icon', 'public', '2025-02-27 08:53:53', '2025-02-27 08:53:53'),
(43, 'App\\Models\\Service', '1', 'image', 'public', '2025-03-21 05:56:38', '2025-03-21 05:56:38'),
(44, 'App\\Models\\Project', '71', 'image', 'public', '2025-03-11 02:56:43', '2025-03-11 02:56:43'),
(45, 'App\\Models\\DataSetting', '111', NULL, 'public', '2025-03-23 03:43:36', '2025-03-23 03:43:36'),
(46, 'App\\Models\\DataSetting', '112', NULL, 'public', '2025-03-17 05:05:03', '2025-03-17 05:05:03'),
(47, 'App\\Models\\SystemSetting', '100', NULL, 'public', '2025-03-20 01:46:50', '2025-03-20 01:46:50'),
(48, 'App\\Models\\SystemSetting', '79', NULL, 'public', '2025-03-20 01:46:50', '2025-03-20 01:46:50'),
(49, 'App\\Models\\Service', '2', 'image', 'public', '2025-03-21 05:55:51', '2025-03-21 05:55:51'),
(50, 'App\\Models\\Skill', '2', 'image', 'public', '2025-03-20 02:28:34', '2025-03-20 02:28:34'),
(51, 'App\\Models\\Skill', '3', 'image', 'public', '2025-03-21 05:45:27', '2025-03-21 05:45:27'),
(52, 'App\\Models\\Skill', '4', 'image', 'public', '2025-03-21 05:46:35', '2025-03-21 05:46:35'),
(53, 'App\\Models\\Skill', '5', 'image', 'public', '2025-03-21 05:47:34', '2025-03-21 05:47:34'),
(54, 'App\\Models\\Skill', '6', 'image', 'public', '2025-03-21 05:49:06', '2025-03-21 05:49:06'),
(55, 'App\\Models\\Skill', '7', 'image', 'public', '2025-03-21 05:49:49', '2025-03-21 05:49:49'),
(56, 'App\\Models\\Skill', '8', 'image', 'public', '2025-03-21 05:50:27', '2025-03-21 05:50:27'),
(57, 'App\\Models\\Service', '3', 'image', 'public', '2025-03-21 05:58:25', '2025-03-21 05:58:25'),
(58, 'App\\Models\\Service', '4', 'image', 'public', '2025-03-21 05:59:34', '2025-03-21 05:59:34'),
(59, 'App\\Models\\Testimonial', '4', 'image', 'public', '2025-03-23 05:30:53', '2025-03-23 05:30:53'),
(60, 'App\\Models\\Testimonial', '5', 'image', 'public', '2025-03-23 05:31:59', '2025-03-23 05:31:59'),
(61, 'App\\Models\\Testimonial', '6', 'image', 'public', '2025-03-23 05:33:50', '2025-03-23 05:33:50'),
(62, 'App\\Models\\Testimonial', '7', 'image', 'public', '2025-03-23 05:36:30', '2025-03-23 05:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(4, 'mail_config', '{\"status\":\"1\",\"name\":\"Janam Pandey\",\"host\":\"mail.thinktankinfotech.com\",\"driver\":\"smtp\",\"port\":\"465\",\"username\":\"info@thinktankinfotech.com\",\"email_id\":\"info@thinktankinfotech.com\",\"encryption\":\"ssl\",\"password\":\"ThinkTankInfoTech#@21^^??\"}', NULL, '2025-03-10 07:17:54'),
(16, 'system_name', 'Janam Pandey', NULL, NULL),
(18, 'logo', '2025-03-10-67ce8be992d07.png', NULL, NULL),
(19, 'phone', '+977-9866077949, +977-9813074888', NULL, NULL),
(20, 'email_address', 'jananpandey1995@gmail.com', NULL, NULL),
(21, 'address', 'Kathmandu Metro 16, Balaju, Kathmandu, Nepal', NULL, NULL),
(22, 'footer_text', 'All Right Reserved', NULL, NULL),
(23, 'customer_verification', '1', NULL, NULL),
(37, 'timezone', 'Asia/Katmandu', NULL, NULL),
(44, 'country', 'NP', NULL, NULL),
(78, 'recaptcha', '{\"status\":\"1\",\"site_key\":\"6Lf8pr0qAAAAABgqOAwm5wLrXmBdr__BFJS2Y6Zu\",\"secret_key\":\"6Lf8pr0qAAAAAEYX6SgutPJ-B3W0L9UnoHIqN3j1\"}', '2025-01-20 16:49:04', '2025-01-20 16:49:04'),
(79, 'language', '[\"en\",\"ne\"]', NULL, '2025-03-20 01:46:50'),
(82, 'icon', '2025-03-10-67ce8be99ab6d.png', NULL, NULL),
(97, 'feature', '[]', NULL, NULL),
(100, 'system_language', '[{\"id\":1,\"direction\":\"ltr\",\"code\":\"en\",\"status\":1,\"default\":true},{\"id\":2,\"direction\":\"ltr\",\"code\":\"ne\",\"status\":1,\"default\":false}]', '2023-07-10 00:56:39', '2025-03-20 01:46:56'),
(134, 'forget_password_mail_status_admin', '1', NULL, NULL),
(153, 'system_php_path', '/usr/bin/php', NULL, NULL),
(193, 'country_picker_status', '0', '2024-07-09 13:53:09', '2024-07-09 13:53:09'),
(194, 'local_storage', '1', '2024-07-09 16:07:20', '2024-07-09 16:07:20'),
(209, 'cookies_text', NULL, NULL, NULL),
(210, 'default_location', '{\"lat\":null,\"lng\":null}', NULL, NULL),
(211, 'timeformat', '12', NULL, NULL),
(212, 'digit_after_decimal_point', NULL, NULL, NULL),
(213, 'push_notification_service_file_content', '{\n  \"type\": \"service_account\",\n  \"project_id\": \"janam-70bc3\",\n  \"private_key_id\": \"5de4441ad35cf390430265858abfc34e3f907f58\",\n  \"private_key\": \"-----BEGIN PRIVATE KEY-----\\nMIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDHi2jjnQgy6bJH\\nOxEGNqVkneF3PztB+Vqan33M1cYMZ4cRZzYpoVwfxjQuk7jLZu8dxCGE2iSr4SoM\\nirFceh/ky48fmBZeJWhywXYIcU4WOknQ17gmyyBn1+QtytoQk3Q33gLAlR7dZAQa\\nzMmN3QRJg+DpkwXPuzDDPe1RVCnY0HqSmiGfudKt+vkmCkBN5sv/Gq19p1CHuoNr\\ngBQwBq1WFDVNMGBfCUeXJ6UR0l3idmxocL1Zg0NKC4qdDfElBqDhLAf2k3RYwZOu\\n7QUaRkh2VSbvof8FyD49Aya68zPMU+5Ta5ZizLlFgTiOFOEtPOQyZZvV2pg2q2ky\\nufA4DPzfAgMBAAECggEAN92D5BWWsgpTazXSMlciPuUktmnxgSr6fsegRLSk2dwy\\nKGEo/Ma8L/khqtiYp/mNgFvktnkMQ0KqrxA1T5qxSzDiRQojWQBIGbin/v0Zy4dO\\nGzYJzHKaA/ihXWCpZHKj2vBA/QHCvmC99XLYCuuRw7M0SLBstBfIMyEnS9mwTY6x\\nJhBZqV+qUpYiXusRWV/ufjIvLSZavRtiH895+KPciyojjxGEGeS6nsAtIpI1+Ei9\\nZ5AIa3GUCgADF6NXWDR8/cBk0C9fHV+RmBVSYJSLbJolvXvBpDl4TVpw8Ts7t4so\\npawnGPRTpuafg1NApDYuNz8thGxwgvlYF54wbWFLQQKBgQD8/yxQMw3o21WzP2ID\\na6qGM1n5Tcob8r3OoG1L1N51BzEsORBi037JLh0vOrHXGAb3BuGmMxNH2MseUWQ+\\nsyFQqkUBZlcV63TKP2Uw8eg3Njf3+GztSz/tUUUqDrpz08MbxBDCcZw2los2HhhT\\nE5tCcLO46q2xHNHI3hbdhfo3aQKBgQDJ6c1Bvuq0KHmPf+QePOidjiERgqokEdwu\\nBgrG50UrNNeOcopR4c+/KDTgn0U97I2gzAYwYi6UiOoR426NgU029QcGVQTZB+ln\\nYe2Xdz3ruu39zWKCvnOacF0uPIsq+cDfReXW8MBEsH3twrbLDVBWumuOJiOgECtK\\nCPuWPtuRBwKBgAGkAfyPKDLvYTHlYlRVWWi/YoD8YSgnPdXeMndAbSTjJA1+XT3W\\n00aotuW8grS7Yigt8j6qrCBWJpMOwhCqBrhIMmRc7omk2kAJgzV7DB93iYthIAu1\\n5jc6xLEOIWVo5SYD8nvgUrwD4+k47r1zLhmTM4cqdm/kmPOthQZwvPupAoGAJWYs\\nAbCGMqaIlZ7ftwYbJAvObjrgntu8B75QwrTVqAIapyTqH+6Ol16wJKb7oVOujAke\\nYFnfPN37VSLmOEmp7rMGARNAWZ7Qibim1HZevsoaCPfA9mymZwXHDKhkMqqeIf0F\\nbIGda1uxh5eYWhX2Ooo/H85KrPwxuH3fc93it4MCgYBBAVX4vgschHb+Ydj8rOFX\\nzYnVywjtFzStfO5NnGcCW2LSoZi9P85feU96+NLj+6viIJpVcEASMflfzgHG0CXP\\n9ukfy6pJBkj2p+0iH6hrWQ8PDtcLVWwtM8KpLzjldKVzK/NgKQCKlJHA9zsd7KWZ\\noduMgbyopSNHJFCZFD42Mg==\\n-----END PRIVATE KEY-----\\n\",\n  \"client_email\": \"firebase-adminsdk-fbsvc@janam-70bc3.iam.gserviceaccount.com\",\n  \"client_id\": \"105140497374677914505\",\n  \"auth_uri\": \"https://accounts.google.com/o/oauth2/auth\",\n  \"token_uri\": \"https://oauth2.googleapis.com/token\",\n  \"auth_provider_x509_cert_url\": \"https://www.googleapis.com/oauth2/v1/certs\",\n  \"client_x509_cert_url\": \"https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-fbsvc%40janam-70bc3.iam.gserviceaccount.com\",\n  \"universe_domain\": \"googleapis.com\"\n}', NULL, NULL),
(214, 'fcm_project_id', 'janam-70bc3', NULL, NULL),
(215, 'fcm_credentials', '{\"apiKey\":\"AIzaSyCEFDZRDS95ct94KIX5ylmDoa8NEY3ZQEI\",\"authDomain\":\"janam-70bc3.firebaseapp.com\",\"projectId\":\"janam-70bc3\",\"storageBucket\":\"janam-70bc3.firebasestorage.app\",\"messagingSenderId\":\"430545914406\",\"appId\":\"1:430545914406:web:e0fd2298ba372136a4f4e7\",\"measurementId\":\"G-ZWHHS5BBCC\"}', NULL, NULL),
(217, 'client_count', '10', NULL, NULL),
(218, 'project_count', '20', NULL, NULL),
(219, 'service_count', '5', NULL, NULL),
(220, 'team_count', '8', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `designation`, `message`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Binod Kadel', 'def.png', 'Director, Sunrise Education Network Pvt. Ltd.', 'I needed a fast web application to manage our overall process, and Janam delivered beyond expectations. The site is beautiful, responsive, and easy to manage thanks to the custom web application he built. My readers love the new experience, and my traffic has doubled!', 1, '2025-03-23 05:30:53', '2025-03-23 05:30:53'),
(5, 'Sanjay Rauniyar', 'def.png', 'Owner, Globaltech Nepal', 'We hired Janam to revamp our blog and content management system, and he exceeded expectations. His understanding of SEO, caching strategies, and Laravel’s dynamic routing improved both performance and visibility. Highly recommend him for any PHP-based project!', 1, '2025-03-23 05:31:59', '2025-03-23 05:31:59'),
(6, 'Hotel Sunway', 'def.png', 'Hospitality Sector', 'The custom web application Janam developed for our team has saved us hours of manual work. From user authentication to real-time data updates, everything works flawlessly. He truly understands business needs and delivers solutions that make a difference!', 1, '2025-03-23 05:33:50', '2025-03-23 05:33:50'),
(7, 'Ram Babu Deo', 'def.png', 'IT Head, AMDA Nepal', 'Janam played a crucial role in improving our existing Tender Management System and Academic Management System. His expertise in Laravel and MySQL helped optimize performance, fix bugs, and introduce new features seamlessly. His support has been invaluable, and I highly recommend him for any web development needs!', 1, '2025-03-23 05:36:30', '2025-03-23 05:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `translationable_type` varchar(255) NOT NULL,
  `translationable_id` bigint(20) UNSIGNED NOT NULL,
  `locale` varchar(255) NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `translationable_type`, `translationable_id`, `locale`, `key`, `value`, `created_at`, `updated_at`) VALUES
(111, 'App\\Models\\EmailTemplate', 1, 'en', 'title', 'Change Password Request', NULL, NULL),
(112, 'App\\Models\\EmailTemplate', 1, 'en', 'body', '<p>The following user has forgotten his password &amp; requested to change/reset their password.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>User Name: {userName}</strong></p>', NULL, NULL),
(113, 'App\\Models\\EmailTemplate', 1, 'en', 'button_name', '', NULL, NULL),
(114, 'App\\Models\\EmailTemplate', 1, 'en', 'footer_text', 'Please contact us for any queries; we’re always happy to help.', NULL, NULL),
(115, 'App\\Models\\EmailTemplate', 1, 'en', 'copyright_text', '© 2023 NACCFL. All rights reserved.', NULL, NULL),
(156, 'App\\Models\\EmailTemplate', 28, 'en', 'title', 'Reset Your Password', NULL, NULL),
(157, 'App\\Models\\EmailTemplate', 28, 'en', 'body', '<p>Please click on this link to reset your Password&nbsp;&rarr;</p>', NULL, NULL),
(158, 'App\\Models\\EmailTemplate', 28, 'en', 'button_name', '', NULL, NULL),
(159, 'App\\Models\\EmailTemplate', 28, 'en', 'footer_text', 'Please contact us for any queries; we’re always happy to help.', NULL, NULL),
(160, 'App\\Models\\EmailTemplate', 28, 'en', 'copyright_text', '© 2024 Knockdoor. All rights reserved.', NULL, NULL),
(3921, 'App\\Models\\AdminRole', 5, 'en', 'name', 'Staff', NULL, NULL),
(3928, 'App\\Models\\Service', 1, 'en', 'name', 'Web Development', NULL, NULL),
(3930, 'App\\Models\\DataSetting', 111, 'en', 'about', '<p>I am passionate about personal and professional growth and seek an organization that values continuous learning. My goal is to contribute to the organization&#39;s success by leveraging my skills and knowledge. With a collaborative mindset and dedication, I aim to work alongside the team to achieve common objectives and exceed expectations. I thrive on challenges and am eager to adapt to evolving landscapes, making a meaningful impact while enriching my own skill set. I am excited to be part of a growth-focused organization, applying this mindset to both company&nbsp; projects and personal projects provided to me.</p>\r\n\r\n<p>&nbsp;</p>', NULL, NULL),
(3937, 'App\\Models\\Skill', 1, 'en', 'name', 'PHP-Laravel', NULL, NULL),
(3941, 'App\\Models\\ResumeDetail', 1, 'en', 'title', 'SEE', NULL, NULL),
(3943, 'App\\Models\\Service', 2, 'en', 'name', 'Mobile Application Development', NULL, NULL),
(3944, 'App\\Models\\Service', 2, 'ne', 'name', 'मोबाइल', NULL, NULL),
(3945, 'App\\Models\\Service', 2, 'en', 'description', 'testing', NULL, NULL),
(3946, 'App\\Models\\Service', 2, 'ne', 'description', 'परीक्षण', NULL, NULL),
(3956, 'App\\Models\\Skill', 3, 'en', 'name', 'jQuery', NULL, NULL),
(3957, 'App\\Models\\Skill', 3, 'en', 'rate', '60', NULL, NULL),
(3958, 'App\\Models\\Skill', 4, 'en', 'name', 'HTML', NULL, NULL),
(3959, 'App\\Models\\Skill', 4, 'en', 'rate', '100', NULL, NULL),
(3960, 'App\\Models\\Skill', 5, 'en', 'name', 'CSS', NULL, NULL),
(3961, 'App\\Models\\Skill', 5, 'en', 'rate', '100', NULL, NULL),
(3962, 'App\\Models\\Skill', 6, 'en', 'name', 'Core PHP', NULL, NULL),
(3963, 'App\\Models\\Skill', 6, 'en', 'rate', '80', NULL, NULL),
(3964, 'App\\Models\\Skill', 7, 'en', 'name', 'Javascript', NULL, NULL),
(3965, 'App\\Models\\Skill', 7, 'en', 'rate', '60', NULL, NULL),
(3966, 'App\\Models\\Skill', 8, 'en', 'name', 'mySQL', NULL, NULL),
(3967, 'App\\Models\\Skill', 8, 'en', 'rate', '70', NULL, NULL),
(3968, 'App\\Models\\ResumeDetail', 3, 'en', 'title', 'High School (+2)', NULL, NULL),
(3969, 'App\\Models\\ResumeDetail', 3, 'en', 'date_range', '2017-2019', NULL, NULL),
(3970, 'App\\Models\\ResumeDetail', 3, 'en', 'name_address', 'Kathmandu Model College, Bagbazar, Kathmandu', NULL, NULL),
(3971, 'App\\Models\\ResumeDetail', 3, 'en', 'details', '<p>I completed my high school in Science Stream with overall GPA of 3.16.</p>', NULL, NULL),
(3972, 'App\\Models\\ResumeDetail', 4, 'en', 'title', 'Bachelor of Science in Information Technology (Bsc. IT)', NULL, NULL),
(3973, 'App\\Models\\ResumeDetail', 4, 'en', 'date_range', '2019-2023', NULL, NULL),
(3974, 'App\\Models\\ResumeDetail', 4, 'en', 'name_address', 'Lord Buddha Education Foundation (LBEF) in academic collaboration with Asia Pacific University of Technology & Innovation, Malaysia', NULL, NULL),
(3975, 'App\\Models\\ResumeDetail', 4, 'en', 'details', '<p>I completed my bachelor degree with overall GPA of 3.38.</p>', NULL, NULL),
(3976, 'App\\Models\\Service', 1, 'en', 'description', 'Build your website with most experienced developer.', NULL, NULL),
(3977, 'App\\Models\\Service', 3, 'en', 'name', 'Software Development', NULL, NULL),
(3978, 'App\\Models\\Service', 3, 'en', 'description', 'Best software development with clean and reusable code for best performance.', NULL, NULL),
(3979, 'App\\Models\\Service', 4, 'en', 'name', 'Digital Marketing', NULL, NULL),
(3980, 'App\\Models\\Service', 4, 'en', 'description', 'For SEO', NULL, NULL),
(3981, 'App\\Models\\Blog', 7, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3982, 'App\\Models\\Blog', 7, 'en', 'blog_title', 'Top Trends In Web Design And Development For 2025', NULL, NULL),
(3983, 'App\\Models\\Blog', 7, 'en', 'blog_details', '<h1>Top Trends In Web Design And Development For 2025</h1>\r\n\r\n<p>With the progress of time, technology is advancing each day. Likewise, websites are also getting better. But, it is not just the website that is changing and advancing, the trends associated with website development and designing are advancing as well. When talking about the trends, you also have to note that although web design and development may seem the same, just like their name and trends, they have their separate entity. The question here is- what is the difference between web design and development? And what are the key points of good web design and development?</p>\r\n\r\n<p>In addition to this, we also talk about what are the trends in web design and development in 2025. Before we move ahead there, let&#39;s first talk about web design and what web development is. Well, web design is the process of creating the visual and interactive aspects of a website by combining graphic design,<a href=\"https://softbenz.com/services/ui-ux-design\"> <strong>user interface (UI) design, and user experience (UX) design</strong></a>, whereas Web development is the process of building, creating, and maintaining websites which involve programming and coding.&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n\r\n<h2>Difference between Web Design and Development</h2>\r\n\r\n<p>We already know what <strong><a href=\"https://softbenz.com/services/website-design-in-nepal\">web design and development</a></strong> means. Now, it&#39;s time to know the differences. There are many differences between web design and development. Some of them lie in definitions, main goal, key aspects, tools used, and language used. Furthermore, we also provide differences regarding skill focus, result, responsibility and example tasks. To make it easier for you, we have presented these differences in tabular form.</p>', NULL, NULL),
(3984, 'App\\Models\\Blog', 7, 'en', 'tags', '#Laravel, #PHP, #MySQL, #Blade, #JavaScript, #AJAX, #Web Development, #Authentication, #Caching, #Performance Optimization', NULL, NULL),
(3985, 'App\\Models\\Blog', 8, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3986, 'App\\Models\\Blog', 8, 'en', 'blog_title', 'The Future of Web Development: Trends to Watch in 2025', NULL, NULL),
(3987, 'App\\Models\\Blog', 8, 'en', 'blog_details', '<p>The web development landscape is constantly evolving, with new technologies and frameworks emerging each year. In 2025, developers and businesses must stay ahead of trends to remain competitive. This blog explores the biggest shifts in web development that will shape the future.</p>\r\n\r\n<h3><strong>Key Web Development Trends for 2025</strong></h3>\r\n\r\n<h4><strong>1. AI and Machine Learning in Web Development</strong></h4>\r\n\r\n<p>Artificial Intelligence (AI) and Machine Learning (ML) are being integrated into web development to enhance user experience and automate tasks. AI-driven code generators like GitHub Copilot are helping developers write code faster, while ML-powered chatbots and recommendation engines provide personalized user experiences.</p>\r\n\r\n<h4><strong>2. Web3 &amp; Decentralization</strong></h4>\r\n\r\n<p>The internet is shifting towards decentralization with Web3, enabling users to have more control over their data. Blockchain-based applications, smart contracts, and decentralized finance (DeFi) platforms are becoming mainstream. Technologies like <strong>Ethereum, IPFS, and Solidity</strong> will gain more adoption in web development.</p>\r\n\r\n<h4><strong>3. Progressive Web Apps (PWAs) on the Rise</strong></h4>\r\n\r\n<p>PWAs combine the best of mobile apps and websites, providing faster performance, offline functionality, and push notifications. Businesses like <strong>Twitter Lite and Starbucks PWA</strong> have already embraced this, and more will follow in 2025.</p>\r\n\r\n<h4><strong>4. Serverless Computing</strong></h4>\r\n\r\n<p>Serverless architecture allows developers to run applications without managing backend servers. Cloud providers like <strong>AWS Lambda, Google Cloud Functions, and Azure Functions</strong> offer scalable solutions where developers pay only for the resources they use.</p>\r\n\r\n<h4><strong>5. Enhanced Cybersecurity</strong></h4>\r\n\r\n<p>As cyber threats increase, web developers must prioritize security measures. Key trends include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Implementing <strong>Zero Trust Architecture (ZTA)</strong></p>\r\n	</li>\r\n	<li>\r\n	<p>Using <strong>biometric authentication</strong></p>\r\n	</li>\r\n	<li>\r\n	<p>Encrypting sensitive data with <strong>Quantum Cryptography</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Keeping up with these trends will help developers create modern, secure, and scalable web applications. Embracing AI, Web3, PWAs, and enhanced cybersecurity will be key to staying relevant in the industry.</p>', NULL, NULL),
(3988, 'App\\Models\\Blog', 8, 'en', 'tags', '#WebDevelopment, #TechTrends, #AI, #MachineLearning, #Web3, #PWAs, #Cybersecurity, #Serverless', NULL, NULL),
(3989, 'App\\Models\\Blog', 9, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3990, 'App\\Models\\Blog', 9, 'en', 'blog_title', 'How to Improve Website Performance: Best Practices for Developers', NULL, NULL),
(3991, 'App\\Models\\Blog', 9, 'en', 'blog_details', '<p>Website speed and performance play a crucial role in user experience and SEO rankings. A slow website can increase bounce rates and negatively impact conversions. Here are some proven strategies to optimize website performance.</p>\r\n\r\n<h3><strong>Best Practices to Improve Website Performance</strong></h3>\r\n\r\n<h4><strong>1. Optimize Images for Faster Loading</strong></h4>\r\n\r\n<p>Large images slow down websites. Use the following methods to optimize images:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Convert images to <strong>WebP format</strong> (smaller file size, better quality).</p>\r\n	</li>\r\n	<li>\r\n	<p>Implement <strong>lazy loading</strong> so images load only when needed.</p>\r\n	</li>\r\n	<li>\r\n	<p>Use tools like <strong>TinyPNG</strong> or <strong>ImageOptim</strong> for compression.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Minify CSS, JavaScript, and HTML</strong></h4>\r\n\r\n<p>Minifying code removes unnecessary characters, reducing file size and improving load time. Use tools like:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Terser</strong> (for JavaScript minification)</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>CSSNano</strong> (for CSS minification)</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>HTMLMinifier</strong> (for HTML minification)</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Use a Content Delivery Network (CDN)</strong></h4>\r\n\r\n<p>A CDN distributes website content across multiple servers worldwide, reducing load times. Popular CDNs include:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Cloudflare</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Amazon CloudFront</strong></p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Akamai</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Enable Browser Caching</strong></h4>\r\n\r\n<p>Caching stores static resources like images, CSS, and JavaScript in the user&rsquo;s browser, so they don&rsquo;t have to be downloaded every time. Use cache-control headers to set expiration times.</p>\r\n\r\n<h4><strong>5. Optimize Database Queries</strong></h4>\r\n\r\n<p>If your site relies on a database (e.g., MySQL, PostgreSQL), optimize queries by:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Using indexes</strong> to speed up search operations.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Reducing redundant queries</strong> by caching database results.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Using database optimization tools</strong> like <strong>MySQL Query Cache</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>By implementing these optimization techniques, you can improve website performance, increase user engagement, and boost SEO rankings.</p>', NULL, NULL),
(3992, 'App\\Models\\Blog', 9, 'en', 'tags', '#WebsitePerformance, #WebOptimization, #CDN, #LazyLoading, #Minification, #SEO, #PageSpeed', NULL, NULL),
(3993, 'App\\Models\\Blog', 10, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3994, 'App\\Models\\Blog', 10, 'en', 'blog_title', 'A Beginner’s Guide to Building a Full-Stack Web Application', NULL, NULL),
(3995, 'App\\Models\\Blog', 10, 'en', 'blog_details', '<p>Full-stack web development involves both frontend (client-side) and backend (server-side) development. This guide walks you through creating a simple <strong>CRUD (Create, Read, Update, Delete) web application</strong> using <strong>React.js</strong> for the frontend and <strong>Node.js with Express</strong> for the backend.</p>\r\n\r\n<h3><strong>Step-by-Step Guide to Building a Full-Stack Web App</strong></h3>\r\n\r\n<h4><strong>Step 1: Choose Your Tech Stack</strong></h4>\r\n\r\n<p>For this project, we will use:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Frontend:</strong> React.js + Tailwind CSS</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Backend:</strong> Node.js + Express.js</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Database:</strong> MongoDB</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Authentication:</strong> JSON Web Token (JWT)</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>Step 2: Set Up the Backend</strong></h4>\r\n\r\n<ol>\r\n	<li>\r\n	<p>Install dependencies:</p>\r\n\r\n	<pre>\r\n\r\n&nbsp;</pre>\r\n\r\n	<div>&nbsp;</div>\r\n	</li>\r\n</ol>', NULL, NULL),
(3996, 'App\\Models\\Blog', 10, 'en', 'tags', '#FullStackDevelopment, #ReactJS, #NodeJS, #ExpressJS, #MongoDB, #CRUDApp, #WebDevelopment', NULL, NULL),
(3997, 'App\\Models\\Blog', 11, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(3998, 'App\\Models\\Blog', 11, 'en', 'blog_title', 'Why SEO Matters in Web Development: Key Optimization Strategies', NULL, NULL),
(3999, 'App\\Models\\Blog', 11, 'en', 'blog_details', '<p>SEO (Search Engine Optimization) helps websites rank higher on search engines, bringing more traffic and engagement. Developers must integrate SEO strategies during website development.</p>\r\n\r\n<h3><strong>Key SEO Optimization Strategies</strong></h3>\r\n\r\n<h4><strong>1. Mobile-First Design</strong></h4>\r\n\r\n<p>Google prioritizes mobile-friendly websites in search rankings. Ensure your website:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Uses <strong>responsive design</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p>Has <strong>fast-loading mobile pages</strong> (AMP).</p>\r\n	</li>\r\n	<li>\r\n	<p>Provides <strong>touch-friendly navigation</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Page Speed Optimization</strong></h4>\r\n\r\n<p>Google considers <strong>Core Web Vitals</strong> like <strong>Largest Contentful Paint (LCP), First Input Delay (FID), and Cumulative Layout Shift (CLS)</strong> for rankings. Optimize by:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Minimizing HTTP requests</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Reducing render-blocking resources</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Keyword Optimization</strong></h4>\r\n\r\n<p>Use relevant keywords in:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Meta titles and descriptions</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>URLs and alt texts</strong>.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Content and headings (H1, H2, H3)</strong>.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Schema Markup</strong></h4>\r\n\r\n<p>Schema markup helps search engines understand your content better. Use <strong>JSON-LD structured data</strong> for rich snippets.</p>\r\n\r\n<p>Integrating SEO strategies in web development ensures better search engine rankings and visibility.</p>', NULL, NULL),
(4000, 'App\\Models\\Blog', 11, 'en', 'tags', '#SEO, #SearchEngineOptimization, #CoreWebVitals, #MobileFirst, #PageSpeed, #SchemaMarkup, #WebDev', NULL, NULL),
(4001, 'App\\Models\\Blog', 12, 'en', 'author_name', 'Janam Pandey', NULL, NULL),
(4002, 'App\\Models\\Blog', 12, 'en', 'blog_title', 'The Best Web Development Tools & Frameworks in 2025', NULL, NULL),
(4003, 'App\\Models\\Blog', 12, 'en', 'blog_details', '<p>Developers use various tools and frameworks to streamline coding and improve efficiency. Here are the top web development tools and frameworks in 2025.</p>\r\n\r\n<h3><strong>Top Web Development Tools &amp; Frameworks</strong></h3>\r\n\r\n<h4><strong>1. Frontend Frameworks</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>React.js</strong> &ndash; Best for building dynamic UIs.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Vue.js</strong> &ndash; Lightweight and easy to integrate.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Svelte</strong> &ndash; Compiler-based, no virtual DOM.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>2. Backend Frameworks</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Node.js + Express</strong> &ndash; Fast and scalable for JavaScript developers.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Django</strong> &ndash; Secure and scalable for Python developers.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Laravel</strong> &ndash; Feature-rich PHP framework.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>3. Databases</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>MongoDB</strong> &ndash; NoSQL database for flexible data storage.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>PostgreSQL</strong> &ndash; Relational database with strong ACID compliance.</p>\r\n	</li>\r\n</ul>\r\n\r\n<h4><strong>4. Version Control &amp; Deployment</strong></h4>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Git &amp; GitHub</strong> &ndash; For version control and collaboration.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Vercel &amp; Netlify</strong> &ndash; For easy frontend deployment.</p>\r\n	</li>\r\n	<li>\r\n	<p><strong>Docker &amp; Kubernetes</strong> &ndash; For containerized deployment.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Choosing the right tools improves development efficiency and scalability. Stay updated with new frameworks to enhance your skillset.</p>', NULL, NULL),
(4004, 'App\\Models\\Blog', 12, 'en', 'tags', '#WebDevelopmentTools, #ReactJS, #Django, #Laravel, #NodeJS, #GitHub, #Docker, #Kubernetes', NULL, NULL),
(4005, 'App\\Models\\Testimonial', 4, 'en', 'name', 'Binod Kadel', NULL, NULL),
(4006, 'App\\Models\\Testimonial', 4, 'en', 'designation', 'Director, Sunrise Education Network Pvt. Ltd.', NULL, NULL),
(4007, 'App\\Models\\Testimonial', 4, 'en', 'message', 'I needed a fast web application to manage our overall process, and Janam delivered beyond expectations. The site is beautiful, responsive, and easy to manage thanks to the custom web application he built. My readers love the new experience, and my traffic has doubled!', NULL, NULL),
(4008, 'App\\Models\\Testimonial', 5, 'en', 'name', 'Sanjay Rauniyar', NULL, NULL),
(4009, 'App\\Models\\Testimonial', 5, 'en', 'designation', 'Owner, Globaltech Nepal', NULL, NULL),
(4010, 'App\\Models\\Testimonial', 5, 'en', 'message', 'We hired Janam to revamp our blog and content management system, and he exceeded expectations. His understanding of SEO, caching strategies, and Laravel’s dynamic routing improved both performance and visibility. Highly recommend him for any PHP-based project!', NULL, NULL),
(4011, 'App\\Models\\Testimonial', 6, 'en', 'name', 'Hotel Sunway', NULL, NULL),
(4012, 'App\\Models\\Testimonial', 6, 'en', 'designation', 'Hospitality Sector', NULL, NULL),
(4013, 'App\\Models\\Testimonial', 6, 'en', 'message', 'The custom web application Janam developed for our team has saved us hours of manual work. From user authentication to real-time data updates, everything works flawlessly. He truly understands business needs and delivers solutions that make a difference!', NULL, NULL),
(4014, 'App\\Models\\Testimonial', 7, 'en', 'name', 'Ram Babu Deo', NULL, NULL),
(4015, 'App\\Models\\Testimonial', 7, 'en', 'designation', 'IT Head, AMDA Nepal', NULL, NULL),
(4016, 'App\\Models\\Testimonial', 7, 'en', 'message', 'Janam played a crucial role in improving our existing Tender Management System and Academic Management System. His expertise in Laravel and MySQL helped optimize performance, fix bugs, and introduce new features seamlessly. His support has been invaluable, and I highly recommend him for any web development needs!', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_settings`
--
ALTER TABLE `data_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resume_details`
--
ALTER TABLE `resume_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storages`
--
ALTER TABLE `storages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storages_data_id_index` (`data_id`),
  ADD KEY `storages_value_index` (`value`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `translations_translationable_id_index` (`translationable_id`),
  ADD KEY `translations_locale_index` (`locale`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_settings`
--
ALTER TABLE `data_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `resume_details`
--
ALTER TABLE `resume_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `storages`
--
ALTER TABLE `storages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4017;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
