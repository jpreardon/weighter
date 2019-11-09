class CreateWeights < ActiveRecord::Migration[6.0]
  def change
    create_table :weights do |t|
      t.date :date
      t.decimal :weight, precision: 5, scale: 2

      t.timestamps
    end
  end
end
