class Weight < ApplicationRecord
  validates :date,  presence: true,
                    uniqueness: true
  validates :weight, presence: true
end
