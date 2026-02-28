-- 02_seed_data.sql
-- Inserts sample data

USE FlowerInventory;
GO

INSERT INTO dbo.categories (name, description, created_at, updated_at)
VALUES
('Seasonal', 'Seasonal flowers', SYSDATETIME(), SYSDATETIME()),
('Indoor', 'Indoor flowers', SYSDATETIME(), SYSDATETIME());
GO

DECLARE @SeasonalId INT = (SELECT id FROM dbo.categories WHERE name='Seasonal');
DECLARE @IndoorId INT = (SELECT id FROM dbo.categories WHERE name='Indoor');

INSERT INTO dbo.flowers (category_id, name, type, price, stock, image_path, created_at, updated_at)
VALUES
(@SeasonalId, 'Rose', 'Classic', 3.50, 8, NULL, SYSDATETIME(), SYSDATETIME()),
(@SeasonalId, 'Tulip', 'Spring', 2.20, 15, NULL, SYSDATETIME(), SYSDATETIME()),
(@IndoorId, 'Orchid', 'Pot', 12.99, 5, NULL, SYSDATETIME(), SYSDATETIME()),
(@IndoorId, 'Peace Lily', 'Pot', 9.49, 6, NULL, SYSDATETIME(), SYSDATETIME());
GO