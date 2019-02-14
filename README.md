# Note
You'll need to add `GIPHY_API_TOKEN=sometokenhere` to the .env file.

# Objective

To demonstrate your OOP and unit/integration testing skills.

# Task

Write a application / service that fetches an animated gif for a given search term. The response should be what you'd expect from a RESTful API (ie. a JSON payload)

You do not need to connect to a real gif server (giphy) webservice, a dummy webservice client that returns random or static values is fine. 

For example, dummy web service has *GET* /v1/gifs/search or *GET* /v1/gifs/random and each request should include **API_KEY** header and response will be something like below:

```javascript
{
  "data": {
    "gif": {
      "title": "Banana"
      "url": "https://www.gifapi.com/banana.gif"
    }
  }
}
```


Provided api example is just an indication, do not feel the need to use them if you don't want to. If something is not clear, improvise.

Use any components/libraries as you see fit. Please use composer where possible if depending on 3rd party code.

**Once completed, please upload your code in github/bitbucket/gitlab and send us the link or zip file.**

# Assessment
Your task will be assessed on your use of namespace, OOP, folder structure, dependency injection, unit/integration testing and commenting against the level of the position for which you have applied.

Points will be deducted for leaving any redundant files in your code.