# Gleopedia
 
## Introduction
In this project, I will be building a world geopedia, that allows users to get useful geographical, economical, and political information about all countries in the world in a structured form.
One of the sites that provide such information is Wikipedia, which has a wealth of information about all the countries in the world. However, the website allows for viewing the information on a single country or a single city of interest at a time, which make it hard to draw any analytics or gross reporting on a global scale.
Your task will to build a database system backend and an application that provide the regional and global analytics and features described next.
In addition to the information requirement on the following page, connecting to google news to retrieve the total covid-19 cases and vaccinations administered for each country (https://news.google.com/covid19/map)


## Database
The database system is based on the information provided on each country and its corresponding capital city listed on Wikipedia (e.g. https://en.wikipedia.org/wiki/Egypt)
My database design stores the following information about each country: 
- Basic: name, official languages, population, driving side, calling code, and timezone Geographical: continent, capital, area (km2), and water percentage
- Political: capital, legislature, president / monarch, and HDI (human development index) Economical: currency, GDP (Purchase Power), GDP (nominal), and Gini Index
- For each president / monarch, you need to store his/her name, birthdate, the date he/she assumed office, and his/her political party. You also need to store information about capital city for each country, including its name, population, area / metro area, governor, and coordinates.
- The system also allows users to store their travel history for different countries, through registering on the system using their email addresses, and pick a username, gender, age, and birthdate. After registering, the users can add their travels for any country, providing their travel dates, their rating of the visits (1-10) and a textual review
  
  
## Parser
A web crawler to crawl the pages from the Wikipedia website for all the world countries, parse the HTML you crawl and extract the relevant fields for populating the non-user tables in your schema. The countries in each continent is available on wikipedia at (https://en.wikipedia.org/wiki/List_of_sovereign_states_and_dependent_territories_in_<c ontinent name>)
E.g. The list of countries in Africa will be available at (https://en.wikipedia.org/wiki/List_of_sovereign_states_and_dependent_territories_in_Africa). 
 
## Website Features
- Add a new user review on a country
- View existing reviews on a given country
- Register a user
- Show all the countries that have a specific legislature
- Show the top 10 countries by GDP, population, area, density, GDP per capita, both globally and within each continent
- Show all the countries who drive on the right vs. on the left
- Query and view a given country / capital city information
- Query and view president / monarch’s information
- Identify the country for a given phone number
- Identify the country of a given city
- Identify the top and bottom 5 countries in each continent in terms of covidcases and vaccination rate
