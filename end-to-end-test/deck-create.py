from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

WAIT_TIMEOUT = 20

driver = webdriver.Chrome()

driver.get("http://localhost:5173/")

wait = WebDriverWait(driver, WAIT_TIMEOUT)

# first login (dependency)
wait = WebDriverWait(driver, WAIT_TIMEOUT)
email_field = wait.until(EC.element_to_be_clickable((By.NAME, "email")))
password_field = wait.until(EC.element_to_be_clickable((By.NAME, "password")))

email_field.send_keys("aiviskri@gmail.com")
password_field.send_keys("admin")
email_field.send_keys(Keys.RETURN)

navbar = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "main-navbar")))

assert "Your decks" in driver.page_source

# --- create deck ---
newDeckButton = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "button")))
newDeckButton.click()

deckNameField = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "form-control")))
deckNameField.send_keys("TestDeck")

# click new card button
newCardButton = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "btn-primary")))
newCardButton.click()

questionField = wait.until(EC.element_to_be_clickable((By.NAME, "cards.0.question")))
answerField = wait.until(EC.element_to_be_clickable((By.NAME, "cards.0.answer")))

# enter card question and answer
questionField.send_keys("TestQuestion")
answerField.send_keys("TestAnswer")

cardElement = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "card")))

assert "Question" in driver.page_source
assert cardElement

# click remove card button
removeButton = wait.until(EC.element_to_be_clickable((By.CLASS_NAME, "btn")))
removeButton.click()

cardElements = driver.find_elements(By.CLASS_NAME, "card")

noCardExists = len(cardElements) == 0

assert noCardExists, "Card not deleted :("

driver.quit()