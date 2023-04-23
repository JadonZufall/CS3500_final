// Stores the website name for use in the navbar.
const websiteName = "Taylor Swift"

/* 
    If you have questions please @JadonZufall in the team.

    This is a constant javascript object that is parsed on load of the webpage in order to add
    links in the navbar to each subpage.

    The reason for doing this instead of just in html is because I didn't want to copy it on each
    page and have to change it everywhere.

    Each page has a verbose, link, and, catagory property.  
    * Verbose - is the name of the link (how it will be represented on the page)
    
    * Link - is the path to the html file from the root directory (generally pages/file.html)
    
    * Catagory - is the drop down menu it will be sorted into, if catagory is None then it will
    *    not be put into a drop down catagory and will come before the drop down catagories.
*/
const websitePages = {
    "index": {
        "verbose": "Home",
        "link": "index",
        "catagory": "None"
    },
    "about": {
        "verbose": "About",
        "link": "about",
        "catagory": "Info"
    },
    "catalog": {
        "verbose": "Catalog",
        "link": "catalog",
        "catagory": "Info"
    },
    "references": {
        "verbose": "References",
        "link": "references",
        "catagory": "Info"
    },
    "sources": {
        "verbose": "Sources",
        "link": "sources",
        "catagory": "Info"
    },
    "music": {
        "verbose": "Music",
        "link": "music",
        "catagory": "Music"
    },
    "awards": {
        "verbose": "Awards",
        "link": "awards",
        "catagory": "Music"
    },
    "philanthropy": {
        "verbose": "Philanthropy",
        "link": "philanthropy",
        "catagory": "Other"
    },
    "tourdates": {
        "verbose": "Tour Dates",
        "link": "tourdates",
        "catagory": "Other"
    },
    "triva": {
        "verbose": "Trivia",
        "link": "trivia",
        "catagory": "Other"
    },
    "merch": {
        "verbose": "Merch",
        "link": "merch",
        "catagory": "Other",
    },
    "publications": {
        "verbose": "Publications",
        "link": "publications",
        "catagory": "Music"
    },
    "listen": {
        "verbose": "Listen",
        "link": "listen",
        "catagory": "Music"
    },
    "acting": {
        "verbose": "Acting",
        "link": "acting",
        "catagory": "Other"
    },
    "previoustours": {
        "verbose": "Previous Tours",
        "link": "previoustours",
        "catagory": "Other"
    },
    "quiz": {
        "verbose": "Quiz",
        "link": "quiz",
        "catagory": "Other"
    },
    "comment": {
        "verbose": "Comment",
        "link": "comment",
        "catagory": "Community"
    },
    "login": {
        "verbose": "Login",
        "link": "login",
        "catagory": "Account"
    },
    "signout": {
        "verbose": "Signout",
        "link": "signout",
        "catagory": "Account"
    },
    "signup": {
        "verbose": "Signup",
        "link": "signup",
        "catagory": "Account"
    }
}


function formatLink(fileName, dirLevel) {
    /* 
        Function that returns the filename formatted in a way so that the root dir is pathed to
        and then it finds the file from there.

        fileName is the name of the file with .html on the end and any path from root included.

        dirLevel is the levels of directories that the file is nested in.
    */
    
    // Go up a directory for each level in dirLevel.
    for (let i = 0; i < dirLevel; i++) {
        fileName = "../" + fileName;
    }

    // Return the formatted string
    return fileName;
}


function createNavbar(currentPage, dirLevel) {
    /* 
        This function creates the navbar from the elements in the websitePage object.
    */
    // Create all the base elements of the navbar and set their attributes.
    let nav = document.createElement("nav");
    nav.className = "navbar navbar-fixed-top navbar-inverse";

    let container = document.createElement("div");
    container.className = "container-fluid";
    nav.appendChild(container);

    let header = document.createElement("navbar-header");
    header.className = "navbar-header";
    container.appendChild(header);

    // Append the branding to the navbar.
    let brand = document.createElement("a");
    brand.className = "navbar-brand";
    brand.innerText = websiteName;
    brand.href = formatLink(websitePages["index"]["link"], dirLevel);
    header.appendChild(brand);

    let navMain = document.createElement("ul");
    navMain.className = "nav navbar-nav"
    container.appendChild(navMain);

    // Create and add all the links outside of a catagory..
    for (let [key, val] of Object.entries(websitePages)) {
        if (val["catagory"] == "None") {
            let li = document.createElement("li");
            li.className = "other";
            if (key === currentPage) {
                li.className = "active";
            }
            navMain.appendChild(li);

            let a = document.createElement("a");
            a.href = formatLink(val["link"], dirLevel);
            a.innerText = val["verbose"];
            li.appendChild(a);
        }
    }

    // Create all the links inside of a catagory.
    let catagories = new Array;
    let catLookup = {};
    for (let [key, val] of Object.entries(websitePages)) {
        if (!catagories.includes(val["catagory"]) && val["catagory"] != "None") {
            catagories.push(val["catagory"])
            let btnMain = document.createElement("li");
            btnMain.className = "dropdown";
            let btnA = document.createElement("a");
            btnA.href="#";
            btnA.class = "dropdown-toggle";
            btnA.setAttribute("data-toggle", "dropdown");
            btnA.role = "button";
            btnA.setAttribute("aria-haspopup", "True");
            btnA.setAttribute("aria-expanded", "False");
            btnA.innerHTML = val["catagory"] + ' <span class="caret"></span>'
            btnMain.appendChild(btnA);
            let btnGroup = document.createElement("ul");
            btnGroup.className = "dropdown-menu";
            btnGroup.id = val["catagory"];
            btnMain.appendChild(btnGroup);
            navMain.appendChild(btnMain);
            catLookup[val["catagory"]] = btnGroup;
        }
    }

    // Add all the links inside of a catagory.
    for (let [key, val] of Object.entries(websitePages)) {
        if (val["catagory"] != "None") {
            let btnGroup = catLookup[val["catagory"]];
            let li = document.createElement("li");
            if (key === currentPage) {
                btnGroup.parentElement.classList.add("active");
            }
            btnGroup.appendChild(li);
            let a = document.createElement("a");
            a.href = formatLink(val["link"], dirLevel);
            a.innerText = val["verbose"];
            li.appendChild(a);
        }
    }

    // Insert the navbar into the document before the firstElementChild.
    document.body.insertBefore(nav, document.body.firstElementChild);
}


function onLoad() {
    /* 
        Function called on page load, it adds the navbar.
    */
    let location = window.location.href;
    let split = location.split("/");
    let documentName = split[split.length - 1];
    let dirLevel = 0;
    if (split[split.length - 2] === "pages") {
        dirLevel += 1;
    }
    let currentPage = documentName.replace(".html", "");
    createNavbar(currentPage, dirLevel);
}

// Calls the onLoad function when this file is imported.
onLoad();
