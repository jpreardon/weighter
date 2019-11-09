class AddNotNullConstraintToDate < ActiveRecord::Migration[6.0]
  def change
    change_column_null(:weights, :date, false)
  end
end
