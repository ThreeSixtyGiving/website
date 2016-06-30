import os
import pytest
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver import ActionChains
from selenium.webdriver.support import expected_conditions as EC
from selenium.common.exceptions import NoSuchElementException


@pytest.fixture(scope="module")
def browser(request):
    browser = webdriver.Chrome('/home/david/Apps/chromedriver')
    browser.implicitly_wait(1)
    request.addfinalizer(lambda: browser.quit())
    return browser


'''
Some Possible servers
live - http://www.threesixtygiving.org/
staging - http://opendataservic.staging.wpengine.com/
local test - http://opendataservic.wpengine.com/
'''


@pytest.fixture(scope="module")
def server_url(request):
    if 'CUSTOM_SERVER_URL' in os.environ:
        return os.environ['CUSTOM_SERVER_URL']
    else:
        return "http://www.threesixtygiving.org/"


@pytest.mark.parametrize(('menu_text', 'sub_menu_text'), [
    ('About', 'News'),
    ('About', 'The team'),
    ('About', 'Governance'),
    ('About', 'The need for data'),
    ('About', 'Vacancies'),
    ('Data', 'Publish Data'),
    ('Data', 'Find Data'),
    ('Data', 'Data Sharing'),
    ('Data', 'Case Studies'),
    ('Support', 'Resources'),
    ('Support', 'FAQs'),
    ('Support', 'Data Quality'),
    ('Standard', 'Reference'),
    ('Standard', 'Identifiers'),
    ('Standard', 'Data Protection'),
    ('Standard', 'Licensing'),
    ('Standard', 'Register')
    ])
def test_drop_down_menus(server_url, browser, menu_text, sub_menu_text):
    browser.get(server_url)
    wait = WebDriverWait(browser, 1)

    menu = wait.until(EC.visibility_of_element_located((By.XPATH, "//ul[@id='menu-main-navigation']/li/a[text()='{0}']".format(menu_text))))
    ActionChains(browser).move_to_element(menu).perform()

    sub_menu = wait.until(EC.visibility_of_element_located((By.XPATH, "//li/a[text()='{0}']".format(sub_menu_text))))
    ActionChains(browser).move_to_element(sub_menu).click().perform()


def test_index_page(server_url, browser):
    browser.get(server_url)
    assert "360Giving | The more we know, the better grants we can make" in browser.title
    href = browser.find_element_by_xpath('//*[@id="post-17"]/div[2]/div/div[1]/a')
    href = href.get_attribute("href")
    assert '{}data'.format(server_url) in href
    assert "NEWS" in browser.find_element_by_id("news").text
    assert "BLOG" not in browser.find_element_by_id("news").text


def test_cookie_message(server_url, browser):
    browser.get(server_url)
    assert "This site uses cookies: Find out more." in browser.find_element_by_tag_name('body').text
    assert "COOKIE POLICY" not in browser.find_element_by_tag_name('body').text


@pytest.mark.parametrize(('text', 'tag_name'), [
    ('360Giving', 'body'),
    ('As soon as a step gives you an identifier, you can stop there and use the given identifier', 'body'),  # Bug #112
    ('If you have an educational establishment', 'body')
    ])
def test_identifiers_page(server_url, browser, text, tag_name):
    browser.get(server_url + 'standard/identifiers/')
    assert text in browser.find_element_by_tag_name(tag_name).text


def test_identifiers_page_not(server_url, browser):
    browser.get(server_url + 'standard/identifiers/')
    assert '360 Giving' not in browser.find_element_by_tag_name('body').text


@pytest.mark.parametrize(('text'), [
    ('360 Giving'),
    ('360 Bridge tool')  # Bug #71
    ])
def test_standard_documentation_page_not(server_url, browser, text):
    browser.get(server_url + 'standard/reference/')
    assert text not in browser.find_element_by_tag_name('body').text


def test_standard_documentation_page_not_xpath(server_url, browser):
    browser.get(server_url + 'standard/reference/')
    # Bug #102
    assert 'Use the three-digit currency code from ISO 4217' not in browser.find_element_by_xpath("//*[@id='post-35']/div[1]/table[1]").text


def test_standard_documentation_page(server_url, browser):
    browser.get(server_url + 'standard/reference/')
    assert '360Giving' in browser.find_element_by_tag_name('body').text


@pytest.mark.parametrize(('text'), [
    ('Recipient Org:County'),
    ('Recipient Org:Country'),
    ('Recipient Org:Description'),
    ('Recipient Org:Web Address'),
    ('Use the three-letter currency code from ISO 4217 eg: GBP')  # Bug #102
    ])
def test_standard_documentation_grants_table(server_url, browser, text):
    browser.get(server_url + 'standard/reference/')
    table = browser.find_element_by_xpath("//*[@id='post-35']/div[1]/table[1]")
    assert text in table.text


def test_standard_documentation_pop_out_page(server_url, browser):
    browser.get(server_url + 'wp-content/plugins/threesixty_docs/docson/index.html#/wp-content/plugins/threesixty_docs/standard/schema/360-giving-schema.json$$expand')
    assert 'The currency used in grant amounts and transactions using an ISO 3-letter code. Use GBP for Pounds Sterling.' in browser.find_element_by_xpath('//*[@id="doc"]/div[1]/div[3]/div[5]/div[1]/div[3]/p').text


# This checks the right path is in place, but not that the file exists
# Use a link-ckecker to establish that
@pytest.mark.parametrize(('link_text', 'path'), [
    ("Directors’ Terms of Reference", "/wp-content/uploads/360Giving-Directors-TORs_FINAL.pdf"),
    ("disclosure policy", "/wp-content/uploads/360Giving-Disclosure-Policy.pdf")
    ])
def test_documents_link(server_url, browser, link_text, path):
    browser.get(server_url + 'about/governance')
    href = browser.find_element_by_link_text(link_text)
    href = href.get_attribute("href")
    assert path in href


@pytest.mark.parametrize(('xpath'), [
    ("//*[@id='post-35']/div[1]/p[5]/a"),
    ("//*[@id='post-35']/div[1]/p[43]/a")
    ])
def test_cove_link(server_url, browser, xpath):
    browser.get(server_url + 'standard/reference/')
    href = browser.find_element_by_xpath(xpath)
    href = href.get_attribute("href")
    assert "http://cove.opendataservices.coop/360/" in href


def test_charitycommission_link(server_url, browser):
    browser.get(server_url + 'standard/identifiers/')
    href = browser.find_element_by_xpath("//*[@id='post-7']/div[1]/ol[2]/li[2]/p/a[1]")
    href = href.get_attribute("href")
    assert "http://www.charitycommission.gov.uk/" in href


def test_contactus_link(server_url, browser):
    browser.get(server_url + 'standard/identifiers/')
    href = browser.find_element_by_xpath("//*[@id='post-7']/div[1]/ol[2]/li[4]/p/a[2]")
    href = href.get_attribute("href")
    assert "/contact/" in href


@pytest.mark.parametrize(('path'), [
    ('standard/reference/'),
    ('standard/identifiers/'),
    ('standard/data-protection/'),
    ('standard/licensing/')
    ])
def test_documentation_pages(server_url, browser, path):
    browser.get(server_url + path)
    browser.find_element_by_id("toc")  # Should have a table of contents
    # Should use a documentation template
    browser.find_element_by_class_name("page-template-page_documentation")


'''
@pytest.mark.parametrize(('logo'), [
    ('heritage-lottery-fund'),
    ('heritage-lottery-fund.jpg'),
    ('arts-council-england.JPG'),
    ('arts-council-northern-ireland.jpg'),
    ('arts-council-wales.jpg'),
    ('department-social-development-northern-ireland.jpg'),
    ('sport-england.jpg'),
    ('wellcome-trust.jpg')
    ])
def test_index_page_logos(server_url,browser,logo):
    browser.get(server_url)
    src = []
    imgs = browser.find_elements_by_tag_name('img')
    for img in imgs:
        src.append(img.get_attribute('src'))
    path = "http://opendataservic.wpengine.com/wp-content/themes/responsive-child/ckan/logos/"
    string = path + logo
    assert string not in src
'''


def test_index_page_slider(server_url, browser):
    browser.get(server_url)
    browser.find_element_by_class_name("metaslider")


def test_data_table(server_url, browser):
    # Table headers
    expected_headers = set([
        ('Logo'),
        ('Organisation'),
        ('Data'),
        ('License')
    ])
    browser.get(server_url + 'data/find-data/')
    table_headers = browser.find_elements_by_tag_name('th')
    table_headers_text = set([x.text for x in table_headers])
    assert expected_headers == table_headers_text


def test_page_h1(server_url, browser):
    browser.get(server_url + 'data/find-data/')
    h1 = browser.find_element_by_tag_name("h1")
    # h1 should not have any links within it
    with pytest.raises(NoSuchElementException):
        h1.find_element_by_tag_name("a")
    '''try:
        h1.find_element_by_tag_name("a")
        assert False
    except NoSuchElementException:
        assert True
    '''
