class CreateWeights < ActiveRecord::Migration[6.0]
  def change
    create_table :weights do |t|
      t.date :date
      t.decimal :weight

      t.timestamps
    end
  end
end
