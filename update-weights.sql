-- Alter weights 2022-10-02 JPR
-- Over the years, the table definition changed from the original. This gets it back
-- to the definition in create-weights.sql. Also, does a bit of cleanup, create dates
-- have not been getting recorded since the move away from Rails.

ALTER TABLE weights
CHANGE updated_at updated_at datetime(6);

UPDATE weights SET updated_at = NULL where updated_at = '0000-00-00 00:00:00';
UPDATE weights SET updated_at = NULL where updated_at = created_at;
UPDATE weights SET created_at = date WHERE created_at = '0000-00-00 00:00:00';

ALTER TABLE weights
CHANGE created_at create_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
CHANGE updated_at update_date timestamp ON UPDATE CURRENT_TIMESTAMP;