class ApplicationController < ActionController::Base
    http_basic_authenticate_with name: ENV.fetch('HTTP_USER'), password: ENV.fetch('HTTP_PASSWORD')
end
