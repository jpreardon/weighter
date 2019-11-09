class AddUniqueConstraintToDate < ActiveRecord::Migration[6.0]
  def change
    add_index(:weights, :date, unique: true)
  end
end
