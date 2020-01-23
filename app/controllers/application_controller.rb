class ApplicationController < ActionController::Base
    before_action :authenticate
    # http_basic_authenticate_with name: ENV.fetch('HTTP_USER'), password: ENV.fetch('HTTP_PASSWORD')
    
    private
    
      def authenticate
        authenticate_or_request_with_http_digest do |username|
          if username == ENV.fetch('HTTP_USER')
            ENV.fetch('HTTP_PASSWORD')
          else
            nil
          end
        end
      end
      
end
