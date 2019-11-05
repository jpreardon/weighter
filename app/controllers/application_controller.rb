class ApplicationController < ActionController::Base
  
  def hello
    render html: 'Hellooooo world!'
  end
  
end
