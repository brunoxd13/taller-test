import React from 'react'
import { Mutation } from 'react-apollo'
import gql from 'graphql-tag'
import Router from 'next/router'
import Button from 'grommet/components/Button'

export const logoutMutation = gql`
  mutation UserLogout {
    user: userLogout {
      uid
      name
    }
  }
`
const LogoutContainer = () => (
  <Mutation mutation={ logoutMutation } onCompleted={ () => Router.push('/') } >
    {(logoutMutate, error, loading) => (
      <div>
        {error && <div>Error! {error.message}</div>}

        <Button onClick={ logoutMutate } disabled={ loading } >
          {loading ? 'Logout...' : 'Logout'}
        </Button>
      </div>
    )}
  </Mutation>
)

export default LogoutContainer
