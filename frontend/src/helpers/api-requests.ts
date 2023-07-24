import axios from "axios";

export async function getUserProfiles(url: string) {
    let response;
    
    response = await axios.get(url)
        .catch(function (error) {
            response = false
        });

    if (response && response.status) {
        return response.data.users
    }

    return false

}

export async function getUserWeather(url: string, new_retrieval: boolean) {
    let response = await axios({
        method: 'get',
        url: url,
        params: {
          refresh: new_retrieval ? 'refresh' : null
        }
      });

    if (response.status === 200 && response.data.success) {
        return response.data
    }

    return false
}