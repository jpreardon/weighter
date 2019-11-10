module ApplicationHelper
  
  # Format dates the way we like
  def formatDate(date)
    return date.strftime("%d-%b-%Y")
  end
end
