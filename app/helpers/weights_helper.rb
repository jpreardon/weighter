module WeightsHelper
  # Return the average weight
  def averageWeight(weight_array)
    average = 0
    weight_array.each do | weight |
      average += weight.weight
    end
    return number_with_precision(average / weight_array.length, precision: 1)  
  end
end
