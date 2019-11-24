module ApplicationHelper
  
  # Format dates the way we like
  def formatDate(date)
    return date.strftime("%d-%b-%Y")
  end
  
  def formatDateWeekdays(date)
    return date.strftime("%A (%d%^b)")
  end
end
