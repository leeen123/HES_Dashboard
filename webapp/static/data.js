
var variableDescriptions = {
        
    "Log_Inc": {
      title: "Log Per Capita Income",
      description: "Measures the per capita income of household heads in log scale. The per capita income is calculated using OECD equivalence scale",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
              <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
              <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
              <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
            </svg>`
    },
    "Highest_Certificate": {
      title: "Educational level",
      description: "This variable measures the educational level of household heads, classifying them into six level",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
              <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
            </svg>`,
      label: ['No Certificate','PMR/SRP','SPM/ SPMV','STPM','Diploma / certificate','Degree/Advance Diploma'],
    },
    "Saiz_HH": {
      title: "Household Size",
      description: "The household size of a household, ranging from 1 to 5.",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
              <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
            </svg>`,
      label: ['1','2','3','4','5++'],
    },
    "Age": {
      title: "Age",
      description: "The age of hosuehold head",
      icon: `<svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 162.978 162.978" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M162.978,101.101l-19.611-39.224l-19.611,39.224h13.209c-8.315,25.958-32.633,44.826-61.324,44.826 c-35.529,0-64.438-28.908-64.438-64.438c0-35.529,28.909-64.438,64.438-64.438c27.376,0,50.764,17.19,60.077,41.325l6.44-12.882 c-12.813-23.595-37.82-39.649-66.512-39.649C33.936,5.844,0,39.778,0,81.489c0,41.708,33.936,75.645,75.645,75.645 c34.924,0,64.331-23.809,72.997-56.032H162.978z"></path> <path d="M35.486,96.582h7.084l2.15-7.749h8.645l2.332,7.749h7.345l-9.362-30.192h-8.96L35.486,96.582z M47.494,77.32 c0.493-1.749,0.941-4.034,1.39-5.823h0.088c0.449,1.789,0.988,4.036,1.527,5.823l1.882,6.413h-6.675L47.494,77.32z"></path> <path d="M81.737,71.722c3.311,0,5.371,0.583,7.029,1.294l1.436-5.466c-1.479-0.715-4.482-1.48-8.377-1.48 c-9.901,0-17.2,5.731-17.253,15.769c-0.042,4.434,1.48,8.372,4.26,10.978c2.778,2.688,6.763,4.076,12.277,4.076 c3.98,0,7.975-0.985,10.075-1.701V79.289H79.943v5.331h4.665v6.313c-0.542,0.274-1.798,0.449-3.365,0.449 c-5.604,0-9.497-3.677-9.497-9.904C71.746,74.944,76.042,71.722,81.737,71.722z"></path> <polygon points="115.175,71.993 115.175,66.395 96.539,66.395 96.539,96.582 115.804,96.582 115.804,90.989 103.394,90.989 103.394,83.821 114.507,83.821 114.507,78.261 103.394,78.261 103.394,71.993 "></polygon> </g> </g> </g></svg>`
    },
    "Sex": {
      title: "Sex",
      description: "The gender of household head, male(1) or female(0)",
      icon: `<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-gender-trans" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1.707L3.5 2.793l.646-.647a.5.5 0 1 1 .708.708l-.647.646.822.822A4 4 0 0 1 8 3c1.18 0 2.239.51 2.971 1.322L14.293 1H11.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 0 1-3.05-5.814l-.95-.949-.646.647a.5.5 0 1 1-.708-.708l.647-.646L1 1.707V3.5a.5.5 0 0 1-1 0zm5.49 4.856a3 3 0 1 0 5.02 3.288 3 3 0 0 0-5.02-3.288"/>
            </svg>`,
      label: ['female','male'],
    },
    "Strata": {
      title: "Strata",
      description: "Strata of a household located, either urban(1) or rural(0)",
      icon: `<svg fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M22,11H19V2a1,1,0,0,0-1-1H6A1,1,0,0,0,5,2V7H2A1,1,0,0,0,1,8V22a1,1,0,0,0,1,1H22a1,1,0,0,0,1-1V12A1,1,0,0,0,22,11Zm-9,1v9H3V9H13Zm1-5H7V3H17v8H15V8A1,1,0,0,0,14,7Zm7,14H19V19a1,1,0,0,0-2,0v2H15V13h6ZM4,10H6v2H4Zm4,0h4v2H8ZM4,14H6v2H4Zm4,0h4v2H8ZM4,18H6v2H4Zm4,0h4v2H8Z"></path></g></svg>`,
      label: ['rural','urban'],
    },
    "Ethnic_Bumiputera": {
      title: "Ethnic-Bumiputera",
      description: "Ethnic Bumiputera",
      icon: `<svg height="66px" width="66px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"></circle> <g> <path style="fill:#000000;" d="M244.87,256H512c0-23.107-3.08-45.489-8.819-66.783H244.87V256z"></path> <path style="fill:#000000;" d="M244.87,122.435h229.556c-15.671-25.572-35.706-48.175-59.069-66.783H244.87V122.435z"></path> <path style="fill:#000000;" d="M256,512c60.249,0,115.626-20.824,159.357-55.652H96.643C140.374,491.176,195.751,512,256,512z"></path> <path style="fill:#000000;" d="M37.574,389.565h436.852c12.581-20.528,22.337-42.969,28.755-66.783H8.819 C15.236,346.596,24.993,369.037,37.574,389.565z"></path> </g> <path style="fill:#000000;" d="M256,256c0-141.384,0-158.052,0-256C114.616,0,0,114.616,0,256H256z"></path> <g> <path style="fill:#ffffff;" d="M170.234,219.13c-34.962,0-63.304-28.343-63.304-63.304s28.343-63.304,63.304-63.304 c10.901,0,21.158,2.757,30.113,7.609c-14.048-13.737-33.26-22.217-54.461-22.217c-43.029,0-77.913,34.883-77.913,77.913 s34.884,77.913,77.913,77.913c21.201,0,40.413-8.48,54.461-22.217C191.392,216.373,181.136,219.13,170.234,219.13z"></path> <polygon style="fill:#ffffff;" points="188.073,111.304 199.312,134.806 224.693,128.942 213.327,152.381 233.739,168.568 208.325,174.297 208.396,200.348 188.073,184.05 167.749,200.348 167.819,174.297 142.405,168.568 162.817,152.381 151.45,128.942 176.833,134.806 "></polygon> </g> </g></svg>`,
      label: ['non-Bumiputera','Bumiputera'],
    },
    "Ethnic_Chinese": {
      title: "Ethnic-Chinese",
      description: "Ethnic Chinese",
      icon: `<svg height="66px" width="66px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"></circle> <g> <path style="fill:#000000;" d="M244.87,256H512c0-23.107-3.08-45.489-8.819-66.783H244.87V256z"></path> <path style="fill:#000000;" d="M244.87,122.435h229.556c-15.671-25.572-35.706-48.175-59.069-66.783H244.87V122.435z"></path> <path style="fill:#000000;" d="M256,512c60.249,0,115.626-20.824,159.357-55.652H96.643C140.374,491.176,195.751,512,256,512z"></path> <path style="fill:#000000;" d="M37.574,389.565h436.852c12.581-20.528,22.337-42.969,28.755-66.783H8.819 C15.236,346.596,24.993,369.037,37.574,389.565z"></path> </g> <path style="fill:#000000;" d="M256,256c0-141.384,0-158.052,0-256C114.616,0,0,114.616,0,256H256z"></path> <g> <path style="fill:#ffffff;" d="M170.234,219.13c-34.962,0-63.304-28.343-63.304-63.304s28.343-63.304,63.304-63.304 c10.901,0,21.158,2.757,30.113,7.609c-14.048-13.737-33.26-22.217-54.461-22.217c-43.029,0-77.913,34.883-77.913,77.913 s34.884,77.913,77.913,77.913c21.201,0,40.413-8.48,54.461-22.217C191.392,216.373,181.136,219.13,170.234,219.13z"></path> <polygon style="fill:#ffffff;" points="188.073,111.304 199.312,134.806 224.693,128.942 213.327,152.381 233.739,168.568 208.325,174.297 208.396,200.348 188.073,184.05 167.749,200.348 167.819,174.297 142.405,168.568 162.817,152.381 151.45,128.942 176.833,134.806 "></polygon> </g> </g></svg>`,
      label: ['non-Chinese','Chinese'],
    },
    "Ethnic_Indian":  {
      title: "Ethnic-Indian",
      description: "Ethnic Indian",
      icon: `<svg height="66px" width="66px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"></circle> <g> <path style="fill:#000000;" d="M244.87,256H512c0-23.107-3.08-45.489-8.819-66.783H244.87V256z"></path> <path style="fill:#000000;" d="M244.87,122.435h229.556c-15.671-25.572-35.706-48.175-59.069-66.783H244.87V122.435z"></path> <path style="fill:#000000;" d="M256,512c60.249,0,115.626-20.824,159.357-55.652H96.643C140.374,491.176,195.751,512,256,512z"></path> <path style="fill:#000000;" d="M37.574,389.565h436.852c12.581-20.528,22.337-42.969,28.755-66.783H8.819 C15.236,346.596,24.993,369.037,37.574,389.565z"></path> </g> <path style="fill:#000000;" d="M256,256c0-141.384,0-158.052,0-256C114.616,0,0,114.616,0,256H256z"></path> <g> <path style="fill:#ffffff;" d="M170.234,219.13c-34.962,0-63.304-28.343-63.304-63.304s28.343-63.304,63.304-63.304 c10.901,0,21.158,2.757,30.113,7.609c-14.048-13.737-33.26-22.217-54.461-22.217c-43.029,0-77.913,34.883-77.913,77.913 s34.884,77.913,77.913,77.913c21.201,0,40.413-8.48,54.461-22.217C191.392,216.373,181.136,219.13,170.234,219.13z"></path> <polygon style="fill:#ffffff;" points="188.073,111.304 199.312,134.806 224.693,128.942 213.327,152.381 233.739,168.568 208.325,174.297 208.396,200.348 188.073,184.05 167.749,200.348 167.819,174.297 142.405,168.568 162.817,152.381 151.45,128.942 176.833,134.806 "></polygon> </g> </g></svg>`,
      label: ['non-Indian','Indian'],
    },
    "Ethnic_Others": {
      title: "Ethnic-Others",
      description: "Ethnic other than Bumiputera, Chinese and Indian",
      icon: `<svg height="66px" width="66px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"></circle> <g> <path style="fill:#000000;" d="M244.87,256H512c0-23.107-3.08-45.489-8.819-66.783H244.87V256z"></path> <path style="fill:#000000;" d="M244.87,122.435h229.556c-15.671-25.572-35.706-48.175-59.069-66.783H244.87V122.435z"></path> <path style="fill:#000000;" d="M256,512c60.249,0,115.626-20.824,159.357-55.652H96.643C140.374,491.176,195.751,512,256,512z"></path> <path style="fill:#000000;" d="M37.574,389.565h436.852c12.581-20.528,22.337-42.969,28.755-66.783H8.819 C15.236,346.596,24.993,369.037,37.574,389.565z"></path> </g> <path style="fill:#000000;" d="M256,256c0-141.384,0-158.052,0-256C114.616,0,0,114.616,0,256H256z"></path> <g> <path style="fill:#ffffff;" d="M170.234,219.13c-34.962,0-63.304-28.343-63.304-63.304s28.343-63.304,63.304-63.304 c10.901,0,21.158,2.757,30.113,7.609c-14.048-13.737-33.26-22.217-54.461-22.217c-43.029,0-77.913,34.883-77.913,77.913 s34.884,77.913,77.913,77.913c21.201,0,40.413-8.48,54.461-22.217C191.392,216.373,181.136,219.13,170.234,219.13z"></path> <polygon style="fill:#ffffff;" points="188.073,111.304 199.312,134.806 224.693,128.942 213.327,152.381 233.739,168.568 208.325,174.297 208.396,200.348 188.073,184.05 167.749,200.348 167.819,174.297 142.405,168.568 162.817,152.381 151.45,128.942 176.833,134.806 "></polygon> </g> </g></svg>`,
      label: ['non-Others','Others'],
    },
    "Region_Centre": {
      title: "Centre Region",
      description: "The centre of Peninsular Malaysia, Including Selangor, Wilayah Kuala Lumpur and Wilayah Putrajaya",
      icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M13 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z"></path> </g></svg>`,
      label: ['non-Region_Centre','Region_Centre'],
    },
    "Region_East": {
      title: "East Region",
      description: "The east coast of Peninsular Malaysia, Including Terengganu, Kelantan and Pahang",
      icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M13 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z"></path> </g></svg>`,
      label: ['non-Region_East','Region_East'],
    },
    "Region_Eastern Malaysia": {
      title: "East Malaysia",
      description: "The East Malaysia, Including Wilayah Labuan, Sabah, Sarawak",
      icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M13 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z"></path> </g></svg>`,
      label: ['non-Eastern Malaysia','Eastern Malaysia'],
    },
    "Region_North": {
      title: "North Region",
      description: "The north coast of Peninsular Malaysia, including Kedah, Pulau Pinang, Perak, Perlis",
      icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M13 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z"></path> </g></svg>`,
      label: ['non-Region North','Region North'],
    },
    "Region_South": {
      title: "South Region",
      description: "The south coast of Peninsular Malaysia, including Negeri Sembilan, Melaka, Johor",
      icon: `<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M13 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path> <path stroke="#000000" stroke-linejoin="round" stroke-width="2" d="M17.5 9.5c0 3.038-2 6.5-5.5 10.5-3.5-4-5.5-7.462-5.5-10.5a5.5 5.5 0 1 1 11 0Z"></path> </g></svg>`,
      label: ['non-Region South','Region South'],
    },

  };

  var chartType = {
  "Log_Inc": "bar",
  "Highest_Certificate": "pie",
  "Saiz_HH": "pie",
  "Age": "bar",
  "Sex": "pie",
  "Strata": "pie",
  "Ethnic_Bumiputera": "pie",
  "Ethnic_Chinese": "pie",
  "Ethnic_Indian": "pie",
  "Ethnic_Others": "pie",
  "Region_Centre": "pie",
  "Region_East": "pie",
  "Region_Eastern Malaysia": "pie",
  "Region_North": "pie",
  "Region_South": "pie"
};
