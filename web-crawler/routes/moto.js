const express = require('express');
const router = express.Router();
const request = require('request');
const axios = require('axios');
const cheerio = require('cheerio');
const { AutopliusMotoMake } = require("../models/AutopliusMotoMake");
const { AutopliusMotoModel } = require("../models/AutopliusMotoModel");

router.get('/makes', async (req, res) => {
  await AutopliusMotoMake.deleteMany();
  request('https://autoplius.lt/quick-search/3', async (error, response, html) => {

    if (!error && response.statusCode === 200) {
      const $ = cheerio.load(html);
      $('.make-and-model-row [data-title]').each( async (i, el) => {
        if (!$(el).hasClass('disabled')) {
          let make = new AutopliusMotoMake({
            autoplius_id : $(el).attr('data-value'),
            title : $(el).attr('data-title')
          })
          make = await make.save();
        }
      });
      const makes = await AutopliusMotoMake.find()
      res.send(makes)
    }

  })
})

// router.get('/makes', async (req, res) => {
//
//   await AutopliusMotoMake.deleteMany();
//   const getWebsiteContent = async (url) => {
//     try {
//       const response = await axios.get(url)
//       const $ = cheerio.load(response.data)
//       const listOfMakes = [];
//
//       $('.make-and-model-row [data-title]').each( (i, el) => {
//         if (!$(el).hasClass('disabled')) {
//           let make = {
//             autoplius_id : $(el).attr('data-value'),
//             title : $(el).attr('data-title')
//           }
//           listOfMakes.push(make)
//         }
//       });
//
//       return listOfMakes
//
//     } catch (error) {
//
//       console.error(error)
//     }
//   }
//
//   const listOfmakes = await getWebsiteContent('https://autoplius.lt/quick-search/3')
//   for (let i = 0; i < listOfmakes.length; i++) {
//     let make = new AutopliusMotoMake({
//       autoplius_id : listOfmakes[i].autoplius_id,
//       title : listOfmakes[i].title
//     })
//     make.save();
//   }
//   const makes = await AutopliusMotoMake.find();
//   res.send(makes)
// })


router.get('/makes/:id', async (req, res) => {
  await AutopliusMotoModel.deleteMany();
  request("https://autoplius.lt/api/vehicle/models?make_id=" + req.params.id + "&category_id=3", async (error, response, html) => {

    if (!error && response.statusCode === 200) {
      const $ = cheerio.load(html);
      const body = $('body').text();
      let modelsArray = body.split(',"children":[]}');
      modelsArray.pop();
      let convertedModels = [];

      for (let i = 0; i < modelsArray.length; i++) {
        let convertedModel = JSON.parse(modelsArray[i].substring(1) + "}")

        if (convertedModel.badge != 0) {
          convertedModels.push(convertedModel);
        }
      }

      for (let i = 0; i < convertedModels.length; i++) {

        let model = new AutopliusMotoModel({
          autoplius_id : convertedModels[i].id,
          title : convertedModels[i].title
        })
        model = await model.save();
      }
      const models = await AutopliusMotoModel.find()
      res.send(models)

    }

  });
})

// router.get('/announcements', (req, res) => {
//
//   req.body.autoplius_make_id = 1590;
//   req.body.autoplius_model_id = 27919;
//   let url = "https://autoplius.lt/skelbimai/motociklai-moto-apranga/motociklai?make_id=" + req.body.autoplius_make_id + "&model_id=" + req.body.autoplius_model_id + "&page_nr="
//   let page = 1;
//   request("https://autoplius.lt/skelbimai/motociklai-moto-apranga/motociklai?make_id=" + req.body.autoplius_make_id + "&model_id=" + req.body.autoplius_model_id + "&page_nr=1", (error, response, html) => {
//
//     if (!error && response.statusCode === 200) {
//       const $ = cheerio.load(html);
//       let list = [];
//
//       while ($(".announcement-item").length !== 0) {
//         let nextPageUrl = url + page
//         request(nextPageUrl, (error, response, html,) => {
//           if (!error && response.statusCode === 200) {
//             $(".announcement-item").each( (i, el) => {
//               let link = $(el).attr("href")
//               let img = $(el).find("img").attr("src")
//               let title = $(el).find(".announcement-title").text()
//               let price = $(el).find("strong").text()
//               let year = $(el).find('[title="Pagaminimo data"]').text()
//               let engineCapacity = title.match(/\d/g).join("")
//               title = title.replace(/[0-9]/g, '').split('cc');
//               title.pop();
//               title = title.toString();
//               title = title.trim()
//               let motorcycle = {
//                 link : link,
//                 img : img,
//                 title : title,
//                 price : price,
//                 year : year,
//                 engineCapacity : engineCapacity
//               }
//               list.push(motorcycle)
//             })
//           }
//
//         })
//         console.log(url);
//         page++
//         if (page == 4) {
//           break;
//         }
//       }
//       res.send(list)
//     }
//
//   })
// })

router.get('/announcements', async (req, res) => {

  req.body.autoplius_make_id = 1590;
  req.body.autoplius_model_id = 27919;
  let next = true;

  let url = "https://autoplius.lt/skelbimai/motociklai-moto-apranga/motociklai?make_id=" + req.body.autoplius_make_id + "&model_id=" + req.body.autoplius_model_id + "&page_nr=";
  const getWebsiteContent = async (url) => {
      try {
        const response = await axios.get(url)
        const $ = cheerio.load(response.data)
        let motoList = [];

        if ($('a[rel="next"]').length !== 0) {
          $(".announcement-item").each( (i, el) => {
            let link = $(el).attr("href")
            let img = $(el).find("img").attr("src")
            let title = $(el).find(".announcement-title").text()
            let price = $(el).find("strong").text()
            let year = $(el).find('[title="Pagaminimo data"]').text()
            let engineCapacity = title.match(/\d/g).join("")
            title = title.replace(/[0-9]/g, '').split('cc');
            title.pop();
            title = title.toString();
            title = title.trim()
            let motorcycle = {
              link : link,
              img : img,
              title : title,
              price : price,
              year : year,
              engineCapacity : engineCapacity
            }
            motoList.push(motorcycle)
          })
        } else {
          next = false
        }
        return motoList

      } catch (error) {

        console.error(error)
      }
    }

    async function getPagesContent() {
      let page = 1;
      let pagesContent = [];
      while(next){
        let nextPageUrl = url + page
        let pageContent = await getWebsiteContent(nextPageUrl);
        pagesContent.push(pageContent);
        page++
        console.log(nextPageUrl);
      }
      return pagesContent;
    }

    let content = await getPagesContent();
    res.send(content)

})

























module.exports = router;
