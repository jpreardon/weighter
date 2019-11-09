require 'test_helper'

class StaticPagesControllerTest < ActionDispatch::IntegrationTest
  
  def setup
    @base_title = "Rewards"
    @auth_headers = {"Authorization" => "Basic #{Base64.encode64('test:pass')}"}
  end
  
  test "should get home when authorized" do
    get static_pages_home_url
    assert_response 401
    get static_pages_home_url, headers: @auth_headers
    assert_response :success
    assert_select "title", "Home | #{@base_title}"
  end
  
  test "should get about when authorized" do
    get static_pages_about_url
    assert_response 401
    get static_pages_about_url, headers: @auth_headers
    assert_response :success
    assert_select "title", "About | #{@base_title}"
  end

end
