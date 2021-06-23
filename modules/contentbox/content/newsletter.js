if(document.getElementsByClassName("home_blog_post_area")[0]){
    const blogDiv = document.getElementsByClassName("home_blog_post_area")[0];
    const homeSection = blogDiv.parentElement;
    console.log(homeSection);
    const newsletterSection = homeSection.children[1];
    newsletterSection.className = "newsletter";
    newsletterSection.style = "";
}