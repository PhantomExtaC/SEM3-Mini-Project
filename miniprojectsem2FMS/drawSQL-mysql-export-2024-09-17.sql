CREATE TABLE `User_Tenant`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Username` VARCHAR(255) NOT NULL,
    `First name` VARCHAR(255) NOT NULL,
    `Last name` VARCHAR(255) NOT NULL,
    `Phone number` BIGINT NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Password` VARCHAR(255) NOT NULL
);
ALTER TABLE
    `User_Tenant` ADD UNIQUE `user_tenant_username_unique`(`Username`);
ALTER TABLE
    `User_Tenant` ADD UNIQUE `user_tenant_phone number_unique`(`Phone number`);
ALTER TABLE
    `User_Tenant` ADD UNIQUE `user_tenant_email_unique`(`Email`);
CREATE TABLE `Reviews`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_ID` BIGINT UNSIGNED NOT NULL,
    `property_ID` BIGINT UNSIGNED NOT NULL,
    `Review` TEXT NOT NULL,
    `Rating` SMALLINT NOT NULL
);
CREATE TABLE `Issue Tickets`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_ID` BIGINT NOT NULL,
    `property_ID` BIGINT NOT NULL,
    `Description` TEXT NOT NULL
);
CREATE TABLE `User_Owner`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `Username` VARCHAR(255) NOT NULL,
    `First name` VARCHAR(255) NOT NULL,
    `Last name` VARCHAR(255) NOT NULL,
    `Phone No` INT NOT NULL,
    `Email` VARCHAR(255) NOT NULL
);
CREATE TABLE `Listings`(
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `house no` SMALLINT NOT NULL,
    `street` VARCHAR(255) NOT NULL,
    `street` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `state` VARCHAR(255) NOT NULL,
    `pin code` INT NOT NULL,
    `Tenant_ID` BIGINT NOT NULL,
    `owner_ID` BIGINT NOT NULL
);
ALTER TABLE
    `Issue Tickets` ADD CONSTRAINT `issue tickets_property_id_foreign` FOREIGN KEY(`property_ID`) REFERENCES `Listings`(`id`);
ALTER TABLE
    `Listings` ADD CONSTRAINT `listings_owner_id_foreign` FOREIGN KEY(`owner_ID`) REFERENCES `User_Owner`(`id`);
ALTER TABLE
    `Listings` ADD CONSTRAINT `listings_tenant_id_foreign` FOREIGN KEY(`Tenant_ID`) REFERENCES `User_Tenant`(`id`);
ALTER TABLE
    `Reviews` ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY(`user_ID`) REFERENCES `User_Tenant`(`id`);
ALTER TABLE
    `Issue Tickets` ADD CONSTRAINT `issue tickets_user_id_foreign` FOREIGN KEY(`user_ID`) REFERENCES `User_Tenant`(`id`);
ALTER TABLE
    `Reviews` ADD CONSTRAINT `reviews_property_id_foreign` FOREIGN KEY(`property_ID`) REFERENCES `Listings`(`id`);