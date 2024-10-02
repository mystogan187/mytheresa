var profileUrls = [
    "https://www.linkedin.com/in/modern-manng-4650a0161",
    "https://www.linkedin.com/in/andy-fang-758159217",
    "https://www.linkedin.com/company/greauxx-llc/",
    "https://www.linkedin.com/company/rons/",
    "https://www.linkedin.com/in/ascencionaf2024",
    "https://www.linkedin.com/company/zbytetecnologia/",
    "https://www.linkedin.com/company/zbytetecnologia/",
    "https://www.linkedin.com/in/er-abhishek-kumar-a8253b23a",
    "https://www.linkedin.com/in/susanpagan",
    "https://www.linkedin.com/in/rajeevan-m-p-954481257"
];

async function fetchData() {
    const url = 'http://localhost:8181/api/get_posts';
    const options = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        },
    };

    try {
        const response = await fetch(url, options);
        const result = await response.json();
        if (result.posts.data !== undefined) {
            profileUrls = result.posts.data.items.map(item => item.profileUrl);
        }

        console.log(profileUrls);

        const listElement = document.getElementById('linkedin-list');
        profileUrls.forEach(url => {
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.href = url;
            link.textContent = url;
            link.target = '_blank';
            listItem.appendChild(link);
            listElement.appendChild(listItem);
        });

    } catch (error) {
        console.error(error);
    }
}

fetchData();