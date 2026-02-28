-- 01_create_schema.sql
-- Recreates FlowerInventory database schema

IF DB_ID('FlowerInventory') IS NULL
BEGIN
    CREATE DATABASE FlowerInventory;
END
GO

USE FlowerInventory;
GO

IF OBJECT_ID('dbo.flowers', 'U') IS NOT NULL DROP TABLE dbo.flowers;
IF OBJECT_ID('dbo.categories', 'U') IS NOT NULL DROP TABLE dbo.categories;
GO

CREATE TABLE dbo.categories (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(160) NOT NULL,
    description NVARCHAR(500) NULL,
    created_at DATETIME2 NULL,
    updated_at DATETIME2 NULL
);
GO

CREATE TABLE dbo.flowers (
    id INT IDENTITY(1,1) PRIMARY KEY,
    category_id INT NOT NULL,
    name NVARCHAR(160) NOT NULL,
    type NVARCHAR(120) NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image_path NVARCHAR(255) NULL,
    created_at DATETIME2 NULL,
    updated_at DATETIME2 NULL,
    CONSTRAINT FK_flowers_categories
        FOREIGN KEY (category_id)
        REFERENCES dbo.categories(id)
);
GO