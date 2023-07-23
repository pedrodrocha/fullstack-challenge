import axios from "axios";

export async function getUserProfiles(url: string) {
    let response = await axios.get(url)

    if (response.status) {
        return response.data.users
    }

    return false

}

export async function getUserWeather(url: string, new_retrieval: boolean) {
    console.log(new_retrieval)
    let response = await axios({
        method: 'get',
        url: url,
        params: {
          refresh: new_retrieval ? 'refresh' : null
        }
      });

    if (response.status === 200 && response.data.success) {
        console.log(response.data)
        return response.data
    }

    return false
}